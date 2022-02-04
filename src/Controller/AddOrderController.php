<?php

namespace App\Controller;

use App\OrderMapper;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Twig\AssetExtension;

class AddOrderController
{
    private OrderMapper $orderMapper;

    public function __construct(OrderMapper $orderMapper)
    {
        $this->orderMapper = $orderMapper;
    }
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $orderInfo = $request->getParsedBody();
        $this->orderMapper->add($orderInfo);
        $redirectUrl = (new AssetExtension())->getAssetUrl('orders');
        return new RedirectResponse($redirectUrl);
    }
}