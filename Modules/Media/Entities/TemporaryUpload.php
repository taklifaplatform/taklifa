<?php

namespace Modules\Media\Entities;

use Closure;
use Carbon\Carbon;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Http\UploadedFile;
use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\Media\Exceptions\CouldNotAddUpload;
use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Modules\Media\Exceptions\TemporaryUploadDoesNotBelongToCurrentSession;

/**
 * Modules\Media\Entities\TemporaryUpload
 *
 * @property int $id
 * @property string $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 *
 * @method static Builder|TemporaryUpload newModelQuery()
 * @method static Builder|TemporaryUpload newQuery()
 * @method static Builder|TemporaryUpload old()
 * @method static Builder|TemporaryUpload query()
 * @method static Builder|TemporaryUpload whereCreatedAt($value)
 * @method static Builder|TemporaryUpload whereId($value)
 * @method static Builder|TemporaryUpload whereSessionId($value)
 * @method static Builder|TemporaryUpload whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class TemporaryUpload extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    public static ?Closure $manipulatePreview = null;

    public static ?string $disk = null;

    public static function validationRules(string $name = 'media'): array
    {
        return [
            $name . '.uuid' => [
                'nullable',
                'exists:media,uuid',
            ],
            $name . '.id' => [
                'nullable',
                'exists:media,id',
            ],
        ];
    }

    public function scopeOld(Builder $builder): void
    {
        $builder->where('created_at', '<=', Carbon::now()->subDay()->toDateTimeString());
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        if (! config('media-library.generate_thumbnails_for_temporary_uploads')) {
            return;
        }

        $conversion = $this
            ->addMediaConversion('preview')
            ->nonQueued();

        $previewManipulation = $this->getPreviewManipulation();

        $previewManipulation($conversion);
    }

    public static function previewManipulation(Closure $closure): void
    {
        static::$manipulatePreview = $closure;
    }

    protected function getPreviewManipulation(): Closure
    {
        return static::$manipulatePreview ?? static function (Conversion $conversion): void {
            $conversion->fit(
                fit: Fit::Contain
            );
        };
    }

    protected static function getDiskName(): string
    {
        return static::$disk ?? config('media-library.disk_name');
    }

    public static function findByMediaUuid(?string $mediaUuid): ?TemporaryUpload
    {
        $mediaModelClass = config('media-library.media_model');

        /** @var Media $media */
        $media = $mediaModelClass::query()
            ->where('uuid', $mediaUuid)
            ->first();

        if (! $media) {
            return null;
        }

        $temporaryUpload = $media->model;

        if (! $temporaryUpload instanceof TemporaryUpload) {
            return null;
        }

        return $temporaryUpload;
    }

    public static function findByMediaUuidInCurrentSession(?string $mediaUuid): ?TemporaryUpload
    {
        if (($temporaryUpload = static::findByMediaUuid($mediaUuid)) === null) {
            return null;
        }

        if (config('media-library.enable_temporary_uploads_session_affinity', true)) {
            if ($temporaryUpload->session_id !== session()->getId()) {
                return null;
            }
        }

        return $temporaryUpload;
    }

    public static function createForFile(
        UploadedFile $uploadedFile,
        string $sessionId,
        string $uuid,
        string $name
    ): self {
        /** @var \Modules\Media\Entities\TemporaryUpload $temporaryUpload */
        $temporaryUpload = static::create([
            'id' => $uuid,
            'session_id' => $sessionId,
        ]);

        if (static::findByMediaUuid($uuid) !== null) {
            throw CouldNotAddUpload::uuidAlreadyExists();
        }

        $temporaryUpload
            ->addMedia($uploadedFile)
            ->setName($name)
            ->withProperties(['uuid' => $uuid])
            ->toMediaCollection('default', static::getDiskName());

        return $temporaryUpload->fresh();
    }

    public static function createForFileFromS3Key(
        string $s3Key,
        string $sessionId,
        string $uuid,
        string $name
    ): self {
        /** @var \Modules\Media\Entities\TemporaryUpload $temporaryUpload */
        $temporaryUpload = static::create([
            'id' => $uuid,
            'session_id' => $sessionId,
        ]);

        if (static::findByMediaUuid($uuid) !== null) {
            throw CouldNotAddUpload::uuidAlreadyExists();
        }

        $temporaryUpload
            ->addMediaFromDisk($s3Key, 's3')
            ->setName($name)
            ->withProperties(['uuid' => $uuid])
            ->toMediaCollection('default', static::getDiskName());

        return $temporaryUpload->fresh();
    }

    public static function createForRemoteFile(
        string $file,
        string $sessionId,
        string $uuid,
        string $name,
        string $diskName
    ): self {
        /** @var \Modules\Media\Entities\TemporaryUpload $temporaryUpload */
        $temporaryUpload = static::create([
            'session_id' => $sessionId,
        ]);

        if (static::findByMediaUuid($uuid) !== null) {
            throw CouldNotAddUpload::uuidAlreadyExists();
        }

        $temporaryUpload
            ->addMediaFromDisk($file, $diskName)
            ->setName($name)
            ->usingFileName($name)
            ->withProperties(['uuid' => $uuid])
            ->toMediaCollection('default', static::getDiskName());

        return $temporaryUpload->fresh();
    }

    public function moveMedia(HasMedia $hasMedia, string $collectionName, string $diskName, string $fileName): Media
    {
        if (config('media-library.enable_temporary_uploads_session_affinity', true)) {
            if ($this->session_id !== session()->getId()) {
                throw TemporaryUploadDoesNotBelongToCurrentSession::create();
            }
        }

        $media = $this->getFirstMedia();

        $temporaryUploadModel = $media->model;
        $uuid = $media->uuid;

        $newMedia = $media->move($hasMedia, $collectionName, $diskName, $fileName);

        $temporaryUploadModel->delete();

        $newMedia->update(compact('uuid'));

        return $newMedia;
    }
}
