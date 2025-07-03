<?php

namespace App\Http\Controllers\API\Email;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Services\EmailService\EmailVerificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends BaseController
{
    public function __construct(protected EmailVerificationService $verificationService) {}

    public function verify(int $id, string $hash): RedirectResponse | JsonResponse
    {
        try {
            $result = $this->verificationService->verify($id, $hash);

            if (!$result['status']) {
                return $this->sendError($result['error'], null, $result['code']);
            }

            if (!empty($result['already_verified'])) {
                return $this->sendResponse(null, 'Email is already verified.');
            }

            $redirectURL = "http://localhost/email-verified";
            return redirect($redirectURL);
        } catch (\Exception $e) {
            return $this->sendError('An error occurred during verification.', $e->getMessage(), 500);
        }
    }

    public function resend(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return $this->sendError('Unauthenticated.', null, 401);
            }

            $result = $this->verificationService->resend($user);

            if (!$result['status']) {
                return $this->sendError($result['error'], null, $result['code']);
            }

            return $this->sendResponse(null, 'Verification link sent.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while resending verification email.', $e->getMessage(), 500);
        }
    }
}
