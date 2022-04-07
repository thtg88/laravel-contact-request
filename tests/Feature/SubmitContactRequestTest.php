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
     * @return void
     * @group crud
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
     * @return void
     * @group crud
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
                'email'   => 'The email must be a string.',
                'message' => 'The message must be a string.',
                'name'    => 'The name must be a string.',
                'phone'   => 'The phone must be a string.',
            ]);
    }

    /**
     * @return void
     * @group crud
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
                'email'   => 'The email must not be greater than 255 characters.',
                'message' => 'The message must not be greater than 4000 characters.',
                'name'    => 'The name must not be greater than 255 characters.',
                'phone'   => 'The phone must not be greater than 255 characters.',
            ]);
    }

    /**
     * @return void
     * @group crud
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
     * @param array $parameters
     *
     * @return string
     */
    public function getRoute(array $parameters = []): string
    {
        return route('contact-request.submit');
    }
}
