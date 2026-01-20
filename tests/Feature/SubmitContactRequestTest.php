<?php

namespace Thtg88\ContactRequest\Tests\Feature;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Thtg88\ContactRequest\Mail\ContactRequested;
use Thtg88\ContactRequest\Mail\ContactRequestedInternal;

class SubmitContactRequestTest extends TestCase
{
    /**
     * @group crud
     *
     * @test
     */
    public function empty_payload_has_required_validation_errors(): void
    {
        $response = $this->json('post', $this->getRoute());
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'email'   => 'The email field is required.',
                'message' => 'The message field is required.',
                'name'    => 'The name field is required.',
                'phone'   => 'The phone field is required.',
            ]);
    }

    /**
     * @group crud
     *
     * @test
     */
    public function strings_validation_errors(): void
    {
        $response = $this->json('post', $this->getRoute(), [
            'email'   => [Str::random(5)],
            'message' => [Str::random(5)],
            'name'    => [Str::random(5)],
            'phone'   => [Str::random(5)],
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'email'   => 'The email field must be a string.',
                'message' => 'The message field must be a string.',
                'name'    => 'The name field must be a string.',
                'phone'   => 'The phone field must be a string.',
            ]);
    }

    /**
     * @group crud
     *
     * @test
     */
    public function too_long_strings_have_max_validation_errors(): void
    {
        $response = $this->json('post', $this->getRoute(), [
            'email'   => Str::random(256),
            'message' => Str::random(4001),
            'name'    => Str::random(256),
            'phone'   => Str::random(256),
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'email'   => 'The email field must not be greater than 255 characters.',
                'message' => 'The message field must not be greater than 4000 characters.',
                'name'    => 'The name field must not be greater than 255 characters.',
                'phone'   => 'The phone field must not be greater than 255 characters.',
            ]);
    }

    /**
     * @group crud
     *
     * @test
     */
    public function successful_submit(): void
    {
        Mail::fake();

        $data = [
            'email'   => $this->faker->safeEmail,
            'message' => $this->faker->text,
            'name'    => $this->faker->firstName.' '.$this->faker->lastName,
            'phone'   => $this->faker->phoneNumber,
        ];

        $response = $this->json('post', $this->getRoute(), $data);
        $response->assertStatus(200)
            ->assertJson([
                'success'         => true,
                'contact_request' => [
                    'email'   => $data['email'],
                    'message' => $data['message'],
                    'name'    => $data['name'],
                    'phone'   => $data['phone'],
                ],
            ]);
        Mail::assertSent(
            ContactRequestedInternal::class,
            static function ($mail) {
                return $mail->hasTo(
                    Config::get('contact-request.mail.internal_notification_address')
                );
            }
        );
        Mail::assertSent(
            ContactRequested::class,
            static function ($mail) use ($data) {
                return $mail->hasTo($data['email']);
            }
        );
    }

    /**
     * Return the route to use for these tests from a given parameters array.
     *
     * @return string
     */
    public function getRoute(): string
    {
        return route('contact-request.submit');
    }
}
