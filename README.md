# WAPILOT PHP/Laravel SDK

Official PHP/Laravel SDK for WAPILOT.io - WhatsApp Business API Integration Platform

## Overview

WAPILOT SDK provides a simple and intuitive way to integrate WhatsApp Business API functionality into your PHP/Laravel applications. This SDK handles all the complexity of API communication, authentication, and data formatting, allowing you to focus on building your application logic.

## Features

- 📱 **Contact Management** - Create, update, and manage WhatsApp contacts
- 👥 **Contact Groups** - Organize contacts into groups for better management
- 💬 **Message Sending** - Send text, media, and interactive messages
- 📝 **Templates** - Manage and send template messages
- 🤖 **Automated Replies** - Set up and manage automated responses
- ✨ **Modern Architecture** - Built with modern PHP 8.0+
- 🔒 **Secure** - Built-in token-based authentication and HTTPS
- 🚀 **Laravel Integration** - Seamless Laravel integration with Facade support

## Installation

You can install the package via composer:

```bash
composer require wapilot/sdk
```

### Laravel Setup

1. The package will automatically register its service provider and facade.

2. Publish the configuration file:

```bash
php artisan vendor:publish --provider="Wapilot\SDK\WapilotServiceProvider"
```

3. Add your WAPILOT credentials to your `.env` file:

```env
WAPILOT_API_TOKEN=your-api-token
WAPILOT_API_URL=https://app.wapilot.io  # Optional
```

## Usage

### Laravel Usage (Recommended)

Using the Facade:

```php
use Wapilot\SDK\Facades\Wapilot;

// Send a message
$result = Wapilot::sendMessage([
    'phone' => '+1234567890',
    'message' => 'Hello from Laravel!'
]);
```

### Standalone PHP Usage

```php
use Wapilot\SDK\WapilotSDK;

$wapilot = new WapilotSDK('your-api-token');

// Send a message
try {
    $result = $wapilot->sendMessage([
        'phone' => '+1234567890',
        'message' => 'Hello from PHP!'
    ]);
    print_r($result);
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## API Reference

### Contact Management

#### Get All Contacts
```php
$contacts = Wapilot::getContacts();
```

#### Create Contact
```php
$newContact = Wapilot::createContact([
    'name' => 'John Doe',
    'phone' => '+1234567890',  // International format with country code
    'email' => 'john@example.com',  // Optional
    'notes' => 'VIP Customer'  // Optional
]);
```

#### Update Contact
```php
$updatedContact = Wapilot::updateContact('contact-uuid', [
    'name' => 'John Smith'
]);
```

#### Delete Contact
```php
Wapilot::deleteContact('contact-uuid');
```

### Message Sending

#### Send Text Message with Interactive Buttons
```php
Wapilot::sendMessage([
    'phone' => '+1234567890',
    'message' => 'Hello! How can we help you today?',
    'header' => 'Welcome Message',  // Optional
    'footer' => 'Reply with a button',  // Optional
    'buttons' => [
        [
            'id' => 'support',
            'title' => 'Get Support'
        ],
        [
            'id' => 'sales',
            'title' => 'Sales Inquiry'
        ]
    ]
]);
```

#### Send Media Message
```php
Wapilot::sendMediaMessage([
    'phone' => '+1234567890',
    'media_type' => 'image',  // 'image', 'video', 'document', 'audio'
    'media_url' => 'https://example.com/image.jpg',
    'caption' => 'Check out our new product!',  // Optional
    'file_name' => 'product.jpg'  // Required for documents
]);
```

#### Send Template Message
```php
Wapilot::sendTemplateMessage([
    'phone' => '+1234567890',
    'template' => [
        'name' => 'appointment_reminder',
        'language' => [
            'code' => 'en'
        ],
        'components' => [
            [
                'type' => 'header',
                'parameters' => [
                    [
                        'type' => 'image',
                        'image' => [
                            'link' => 'https://example.com/appointment.jpg'
                        ]
                    ]
                ]
            ],
            [
                'type' => 'body',
                'parameters' => [
                    [
                        'type' => 'text',
                        'text' => 'John Doe'
                    ],
                    [
                        'type' => 'text',
                        'text' => '3:00 PM'
                    ]
                ]
            ]
        ]
    ]
]);
```

### Contact Groups

#### Get All Groups
```php
$groups = Wapilot::getContactGroups();
```

#### Create Group
```php
$newGroup = Wapilot::createContactGroup([
    'name' => 'VIP Customers',
    'description' => 'Our premium customers'  // Optional
]);
```

#### Update Group
```php
$updatedGroup = Wapilot::updateContactGroup('group-uuid', [
    'name' => 'Premium Customers'
]);
```

#### Delete Group
```php
Wapilot::deleteContactGroup('group-uuid');
```

### Automated Replies

#### Get All Automated Replies
```php
$replies = Wapilot::getCannedReplies();
```

#### Create Automated Reply
```php
$newReply = Wapilot::createCannedReply([
    'name' => 'Welcome Message',
    'message' => 'Thank you for contacting us! Our team will respond shortly.',
    'keywords' => ['hi', 'hello', 'hey']  // Optional trigger keywords
]);
```

#### Update Automated Reply
```php
$updatedReply = Wapilot::updateCannedReply('reply-uuid', [
    'message' => 'Thank you for reaching out! We will get back to you soon.'
]);
```

#### Delete Automated Reply
```php
Wapilot::deleteCannedReply('reply-uuid');
```

### Templates

#### Get All Templates
```php
$templates = Wapilot::getTemplates();
```

## Error Handling

The SDK uses PHP exceptions for error handling:

```php
try {
    $contacts = Wapilot::getContacts();
} catch (\GuzzleHttp\Exception\ClientException $e) {
    // API Error (4xx response)
    echo 'API Error: ' . $e->getResponse()->getBody()->getContents();
    echo 'Status Code: ' . $e->getResponse()->getStatusCode();
} catch (\Exception $e) {
    // Other errors
    echo 'Error: ' . $e->getMessage();
}
```

Common Error Codes:
- 401: Invalid or expired API token
- 400: Invalid request parameters
- 404: Resource not found
- 429: Rate limit exceeded
- 500: Server error

## Best Practices

1. **Error Handling**: Always implement proper error handling using try/catch blocks
2. **Token Security**: Never expose your API token in client-side code
3. **Rate Limiting**: Implement proper rate limiting in your application
4. **Message Templates**: Use templates for recurring messages
5. **Contact Management**: Keep contact information up to date
6. **Testing**: Test your integration thoroughly in a development environment

## Support

For support or inquiries, please contact:
- Email: support@wapilot.io

## License

MIT License - feel free to use this SDK in your projects.
