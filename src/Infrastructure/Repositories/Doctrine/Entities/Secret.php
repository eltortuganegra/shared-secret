<?php

namespace sdmd\Infrastructure\Repositories\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="secret")
 */
class Secret
{
    /**
     * @Id()
     * @GeneratedValue()
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(name="secret_id",type="string", length=255)
     */
    private $secretId;

    /**
     * @Column(type="text")
     */
    private $message;

    /**
     * @Column(name="expired_at",type="datetime", nullable=false)
     */
    private $expiredAt;

    /**
     * @Column(name="expiration_time",type="integer", nullable=false)
     */
    private $expirationTime;

    public function getId()
    {
        return $this->id;
    }

    public function getSecretId(): ?string
    {
        return $this->secretId;
    }

    public function setSecretId(string $secretId): self
    {
        $this->secretId = $secretId;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getExpiredAt()
    {
        return $this->expiredAt;
    }

    public function setExpiredAt($expiredAt): void
    {
        $this->expiredAt = $expiredAt;
    }

    public function getExpirationTime(): int
    {
        return (int)$this->expirationTime;
    }

    public function setExpirationTime($expirationTime): void
    {
        $this->expirationTime = $expirationTime;
    }
}
