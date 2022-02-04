<?php
declare(strict_types=1);

namespace App\Controller;

use App\OrderMapper;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

class OrdersListController
{
    private Environment $twig;
    private OrderMapper $orderMapper;

    public function __construct(Environment $twig, OrderMapper $orderMapper)
    {
        $this->twig = $twig;
        $this->orderMapper = $orderMapper;
    }

    /**
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\LoaderError
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $response = new Response();
        $orders = $this->orderMapper->getAll();
        $body = $this->twig->render('orders.twig', ['orders' => $orders]);
        $response->getBody()->write($body);
        return $response;
    }
}