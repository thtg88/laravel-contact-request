<?php

namespace Thtg88\LaravelContactRequest\Tests\Feature;

use Illuminate\Support\Str;

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
                'email' => 'The email field is required.',
                'message' => 'The message field is required.',
                'name' => 'The name field is required.',
                'phone' => 'The phone field is required.',
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
            'email' => [Str::random(5)],
            'message' => [Str::random(5)],
            'name' => [Str::random(5)],
            'phone' => [Str::random(5)],
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'email' => 'The email must be a string.',
                'message' => 'The message must be a string.',
                'name' => 'The name must be a string.',
                'phone' => 'The phone must be a string.',
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
            'email' => Str::random(256),
            'message' => Str::random(4001),
            'name' => Str::random(256),
            'phone' => Str::random(256),
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'email' => 'The email may not be greater than 255 characters.',
                'message' => 'The message may not be greater than 4000 characters.',
                'name' => 'The name may not be greater than 255 characters.',
                'phone' => 'The phone may not be greater than 255 characters.',
            ]);
    }

    /**
     * @return void
     * @group crud
     * @test
     */
    public function successful_submit(): void
    {
        $data = [
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->text,
            'name' => $this->faker->firstName.' '.$this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
        ];

        $response = $this->json('post', $this->getRoute(), $data);
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'contact_request' => [
                    'email' => $data['email'],
                    'message' => $data['message'],
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                ],
            ]);
    }

    /**
     * Return the route to use for these tests from a given parameters array.
     *
     * @param array $parameters
     * @return string
     */
    public function getRoute(array $parameters = []): string
    {
        return route('laravel-contact-request.submit');
    }
}
