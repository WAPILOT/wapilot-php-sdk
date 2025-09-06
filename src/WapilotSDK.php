<?php

namespace Wapilot\SDK;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WapilotSDK
{
    protected Client $client;
    protected string $baseURL;
    protected string $token;

    public function __construct(string $token, string $baseURL = 'https://app.wapilot.io')
    {
        if (empty($token)) {
            throw new \InvalidArgumentException('API token is required');
        }

        $this->token = $token;
        $this->baseURL = $baseURL;
        $this->client = new Client([
            'base_uri' => $this->baseURL,
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    // Contacts API
    public function getContacts(): array
    {
        return $this->request('GET', '/api/contacts');
    }

    public function createContact(array $contactData): array
    {
        return $this->request('POST', '/api/contacts', $contactData);
    }

    public function updateContact(string $uuid, array $contactData): array
    {
        return $this->request('PUT', "/api/contacts/{$uuid}", $contactData);
    }

    public function deleteContact(string $uuid): array
    {
        return $this->request('DELETE', "/api/contacts/{$uuid}");
    }

    // Contact Groups API
    public function getContactGroups(): array
    {
        return $this->request('GET', '/api/contact-groups');
    }

    public function createContactGroup(array $groupData): array
    {
        return $this->request('POST', '/api/contact-groups', $groupData);
    }

    public function updateContactGroup(string $uuid, array $groupData): array
    {
        return $this->request('PUT', "/api/contact-groups/{$uuid}", $groupData);
    }

    public function deleteContactGroup(string $uuid): array
    {
        return $this->request('DELETE', "/api/contact-groups/{$uuid}");
    }

    // Automated Replies API
    public function getCannedReplies(): array
    {
        return $this->request('GET', '/api/canned-replies');
    }

    public function createCannedReply(array $replyData): array
    {
        return $this->request('POST', '/api/canned-replies', $replyData);
    }

    public function updateCannedReply(string $uuid, array $replyData): array
    {
        return $this->request('PUT', "/api/canned-replies/{$uuid}", $replyData);
    }

    public function deleteCannedReply(string $uuid): array
    {
        return $this->request('DELETE', "/api/canned-replies/{$uuid}");
    }

    // Messages API
    public function sendMessage(array $messageData): array
    {
        return $this->request('POST', '/api/send', $messageData);
    }

    public function sendMediaMessage(array $mediaData): array
    {
        return $this->request('POST', '/api/send/media', $mediaData);
    }

    public function sendTemplateMessage(array $templateData): array
    {
        return $this->request('POST', '/api/send/template', $templateData);
    }

    // Templates API
    public function getTemplates(): array
    {
        return $this->request('GET', '/api/templates');
    }

    protected function request(string $method, string $endpoint, array $data = []): array
    {
        try {
            $options = [];
            if (!empty($data)) {
                $options['json'] = $data;
            }

            $response = $this->client->request($method, $endpoint, $options);
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new \RuntimeException(
                "API request failed: {$e->getMessage()}",
                $e->getCode(),
                $e
            );
        }
    }
}
