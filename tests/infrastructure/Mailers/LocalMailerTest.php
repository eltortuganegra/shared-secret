<?php


use SharedSecret\Infrastructure\Mailers\LocalMailerFactoryInterfaceImp;
use SharedSecret\Infrastructure\Mailers\MailerFactory;
use SharedSecret\ValueObjects\ValueObjectsFactory;
use PHPUnit\Framework\TestCase;

class LocalMailerTest extends TestCase
{
    public function testItShouldSendMailToDefaultAtEltortuganegraDotCom()
    {
        // Arrange
        $mailFactory = ValueObjectsFactory::getMailFactory();
        $fromMail = $mailFactory->create('from@eltortuganegra.com');
        $toMail = $mailFactory->create('to@eltortuganegra.com');
        $subject = 'Subject';
        $body = 'This is a test.';
        $mailer = MailerFactory::createLocalMailer();
        $mailer->send($fromMail, $toMail, $subject, $body);

        // Act
        $isMailSent = $mailer->isMailSent();

        // Assert
        $this->assertTrue($isMailSent, 'Mail has not been sent.');
    }

}
