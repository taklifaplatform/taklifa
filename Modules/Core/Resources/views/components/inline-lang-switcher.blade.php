<div style="display: flex; justify-content: center; align-items: center;">
    <div
        style="
        display: inline-flex;
        padding: 4px;
        background: #ECEEF1;
        border-radius: 8px;
        ">
        <a href="{{ route('change-lang', ['lang' => 'en']) }}"
            style="height: 32px; padding-left: 24px; padding-right: 24px; background:{{ app()->getLocale() === 'en' ? 'white' : '' }}; box-shadow:{{ app()->getLocale() === 'en' ? '0px 1px 3px rgba(0, 0, 0, 0.16)' : '' }}; border-radius: 8px; flex-direction: column; justify-content: center; align-items: center; gap: 10px; display: flex; transition: all 0.2s ease;">
            <div
                style="color: {{ app()->getLocale() === 'en' ? '#059669' : '#4B5563' }}; font-size: 14px; font-family: DM Sans; font-weight: 500; line-height: 20px; word-wrap: break-word">
                {{ app()->getLocale() === 'en' ? 'English' : 'الإنجليزية' }}</div>
        </a>
        <a href="{{ route('change-lang', ['lang' => 'ar']) }}"
            style="height: 32px; padding-left: 24px; padding-right: 24px; background:{{ app()->getLocale() === 'en' ? '' : 'white' }}; box-shadow:{{ app()->getLocale() === 'en' ? '' : '0px 1px 3px rgba(0, 0, 0, 0.16)' }}; border-radius: 8px; flex-direction: column; justify-content: center; align-items: center; gap: 10px; display: flex; transition: all 0.2s ease;">
            <div
                style="color: {{ app()->getLocale() === 'en' ? '#4B5563' : '#059669' }}; font-size: 14px; font-family: DM Sans; font-weight: 500; line-height: 20px; word-wrap: break-word">
                {{ app()->getLocale() === 'en' ? 'Arabic' : 'العربية' }}</div>
        </a>
    </div>

</div>
