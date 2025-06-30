<?php

use Illuminate\Support\Facades\Route;
use Modules\Company\Http\Controllers\CompanyController;
use Modules\Company\Http\Controllers\CompanyAdminController;
use Modules\Company\Http\Controllers\CompanyBranchController;
use Modules\Company\Http\Controllers\CompanyMemberController;
use Modules\Company\Http\Controllers\CompanyInvitationController;
use Modules\Company\Http\Controllers\CompanyBranchAdminController;
use Modules\Company\Http\Controllers\MemberAcceptInvitationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Company Admins
 */
Route::middleware(['auth:sanctum'])->prefix('/admin/companies')->group(static function (): void {
    /**
     * Manage Company Routes
     */
    Route::get('/', [CompanyAdminController::class, 'list']);
    Route::get('/{company}', [CompanyAdminController::class, 'retrieve']);
    Route::post('/', [CompanyAdminController::class, 'create']);
    Route::put('/{company}', [CompanyAdminController::class, 'update']);
    Route::delete('/{company}', [CompanyAdminController::class, 'delete']);
    Route::post('/{company}/change-active-company', [CompanyAdminController::class, 'changeActiveCompany']);

    Route::delete('/{company}/members/{member}', [CompanyMemberController::class, 'delete']);

    Route::get('/{company}/invitation', [CompanyInvitationController::class, 'list']);
    Route::get('/{company}/invitation/{companyInvitation}', [CompanyInvitationController::class, 'retrieve']);
    Route::post('/{company}/invitation', [CompanyInvitationController::class, 'create']);
    Route::put('/{company}/invitation/{companyInvitation}', [CompanyInvitationController::class, 'update']);
    Route::delete('/{company}/invitation/{companyInvitation}', [CompanyInvitationController::class, 'delete']);

    /**
     * Manage Company Branch Routes
     */
    Route::get('/{company}/branches', [CompanyBranchAdminController::class, 'list']);
    Route::get('/{company}/branches/{companyBranch}', [CompanyBranchAdminController::class, 'retrieve']);
    Route::post('/{company}/branches', [CompanyBranchAdminController::class, 'create']);
    Route::put('/{company}/branches/{companyBranch}', [CompanyBranchAdminController::class, 'update']);
    Route::delete('/{company}/branches/{companyBranch}', [CompanyBranchAdminController::class, 'delete']);
});

/**
 * Company Admins
 */
Route::prefix('/companies')->group(static function (): void {
    // Public endpoints company
    Route::get('', [CompanyController::class, 'fetchAllCompanies']);
    Route::get('/{company}', [CompanyController::class, 'retrieveCompany']);

    Route::get('/{company}/members', [CompanyMemberController::class, 'list']);
    Route::get('/{company}/members/{member}', [CompanyMemberController::class, 'retrieve']);

    Route::get('/{company}/branches', [CompanyBranchController::class, 'fetchAllBranches']);
    Route::get('/{company}/branches/{companyBranch}', [CompanyBranchController::class, 'retrieveBranch']);
});

Route::prefix('/company-invitation')->group(static function (): void {
    // for public access
    Route::get('/{invitationCode}', [MemberAcceptInvitationController::class, 'retrieve']);
    Route::post('/{invitationCode}/reject', [MemberAcceptInvitationController::class, 'reject']);
    Route::post('/{invitationCode}', [MemberAcceptInvitationController::class, 'accept'])
        ->middleware('auth:sanctum');
});
