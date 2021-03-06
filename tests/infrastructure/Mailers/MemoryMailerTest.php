<?php


use SharedSecret\Infrastructure\Mailers\MailerFactory;
use SharedSecret\Infrastructure\Mailers\MemoryMailerFactoryInterfaceImp;
use SharedSecret\ValueObjects\ValueObjectsFactory;
use PHPUnit\Framework\TestCase;

class MemoryMailerTest extends TestCase
{
    public function testItShouldSendDefaultEmail() {
        // Arrange
        $mailFactory = ValueObjectsFactory::getMailFactory();
        $fromMail = $mailFactory->create('from@eltortuganegra.com');
        $toMail = $mailFactory->create('to@eltortuganegra.com');
        $subject = 'Subject';
        $body = 'This is a test.';
        $mailer = MailerFactory::createMemoryMailer();
        $mailer->send($fromMail, $toMail, $subject, $body);

        // Act
        $isMailSent = $mailer->isMailSent();

        // Assert
        $this->assertTrue($isMailSent, 'Email has not been sent.');
    }

}
