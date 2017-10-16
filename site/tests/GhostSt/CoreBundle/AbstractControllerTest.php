<?php

declare(strict_types = 1);

namespace Tests\GhostSt\CoreBundle;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AbstractControllerTest extends WebTestCase
{

    /**
     * Веб-клиент
     *
     * @var Client
     */
    private $client;

    /**
     * Менеджер сущностей
     *
     * @var DocumentManager
     */
    private $entityManager;

    /**
     * Установка окружения
     */
    protected function setUp()
    {
        parent::setUp();

        $this->client        = static::createClient();
        $this->entityManager = static::$kernel->getContainer()->get('doctrine_mongodb')->getManager();
    }

    /**
     * Очистка окружения
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->getConnection()->close();
        $this->entityManager->close();
        $this->entityManager = null;
        $this->client        = null;
        gc_collect_cycles();
    }


    /**
     * Выполняет POST-запрос (json)
     *
     * @param string $url
     * @param array  $content
     *
     * @return Response
     */
    protected function post($url, $content = [])
    {
        $this->authenticate();

        $this->client->request(
            Request::METHOD_POST,
            $url,
            [],
            [],
            [],
            $content
        );

        return $this->client->getResponse();
    }

    private function authenticate()
    {
        $session = $this->client->getContainer()->get('session');

        // the firewall context defaults to the firewall name
        $firewallContext = 'main';

        $token = new UsernamePasswordToken('GhostSt', null, $firewallContext, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}
