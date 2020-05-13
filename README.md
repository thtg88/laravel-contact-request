# Laravel Contact Request

Send an email from your contact form.

## Table of Contents

* [Installation](#installation)
* [Usage](#usage)
    * [Route](#route)
    * [Validation](#validation)
    * [Captcha](#captcha)
    * [Mail](#mail)
* [License](#license)
* [Security Vulnerabilities](#security-vulnerabilities)

## Installation

``` bash
composer require thtg88/laravel-contact-request
```

## Usage

Laravel Contact Request exposes a route to send an email from given data.

### Route

The route is available at `POST /contact-requests`.

You can customise the route by adding a prefix to the default one. This can be achieved by adding a `LARAVEL_CONTACT_REQUEST_ROUTE_PREFIX` variable to your `.env` file, for example:
```
LARAVEL_CONTACT_REQUEST_ROUTE_PREFIX="api/v1"
```

### Validation

The data is validated by the [`SubmitContactRequestRequest`](src/Http/Requests/SubmitContactRequestRequest) class.

The validation rules are the following:
```
'email' => 'required|string|email|max:255',
'message' => 'required|string|max:4000',
'name' => 'required|string|max:255',
'phone' => 'required|string|max:255',
```

### Captcha

Laravel Contact Request supports Google ReCaptcha V2. This must be sent in a variable called `g_recaptcha_response` or `g-recaptcha-response` in the original payload.

You can enable ReCaptcha V2 support by adding the following to your `.env` variable:
```
LARAVEL_CONTACT_REQUEST_RECAPTCHA_MODE=true
```

### Mail

Laravel Contact Request will send an email confirmation of the contact request to the email provided in the request, and one to an internal recipient of your choice.

You can customise the internal recipient by adding a variable to your `.env` file:
```
LARAVEL_CONTACT_REQUEST_MAIL_INTERNAL_NOTIFICATION_ADDRESS=mail@example.com
```

You can also customise the following:
- Email to internal recipient subject: `LARAVEL_CONTACT_REQUEST_MAIL_INTERNAL_SUBJECT="Contact Request Internal Subject"`
- Email confirmation subject to the recipient specified in the request: `LARAVEL_CONTACT_REQUEST_MAIL_SUBJECT="Contact Request Receipt"`
- Signature of the email confirmation: `LARAVEL_CONTACT_REQUEST_MAIL_SIGNATURE_NAME="John Doe"`

The mail views are a simple HTML, but you can customise those as well by specifying a view in your project, similarly to how you return views in controller like `view('view.name')`.

- Main email HTML layout: `LARAVEL_CONTACT_REQUEST_MAIL_VIEWS_LAYOUT=layouts.email`
- Internal notification HTML view: `LARAVEL_CONTACT_REQUEST_MAIL_VIEWS_REQUESTED_INTERNAL=emails.contact.internal`
- Internal notification plain view: `LARAVEL_CONTACT_REQUEST_MAIL_VIEWS_REQUESTED_INTERNAL_PLAIN=emails.contact.internal_plain`
- Notification to recipient provided in request - HTML view: `LARAVEL_CONTACT_REQUEST_MAIL_VIEWS_REQUESTED=emails.contact.requested`
- Notification to recipient provided in request - plain view: `LARAVEL_CONTACT_REQUEST_MAIL_VIEWS_REQUESTED=emails.contact.requested_plain`

**More customisation coming soon!**

## License

Laravel Contact Request is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel Contact Request, please send an e-mail to Marco Marassi at security@marco-marassi.com. All security vulnerabilities will be promptly addressed.
