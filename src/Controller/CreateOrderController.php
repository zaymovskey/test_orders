<?php
declare(strict_types=1);

namespace App\Controller;

use App\ProductMapper;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

class CreateOrderController
{
    private Environment $twig;
    private ProductMapper $productMapper;

    public function __construct(Environment $twig, ProductMapper $productMapper)
    {
        $this->twig = $twig;
        $this->productMapper = $productMapper;
    }

    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $response = new Response();
        $products = $this->productMapper->getAll();
        $body = $this->twig->render('create_order.twig', ['products' => $products]);
        $response->getBody()->write($body);
        return $response;
    }
}