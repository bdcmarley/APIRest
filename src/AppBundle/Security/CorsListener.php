<?php
namespace AppBundle\Security;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class CorsListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $responseHeaders = $event->getResponse()->headers;

        $responseHeaders->set('Access-Control-Allow-Headers', 'origin, content-type, accept, credentials');
        $responseHeaders->set('Access-Control-Allow-Origin', '*');
        $responseHeaders->set('Access-Control-Allow-Credentials', 'true');
        $responseHeaders->set('Access-Control-Allow-ContentType', 'true');
        $responseHeaders->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        // $responseHeaders->set('Access-Control-Allow-Headers: Content-Type Authorization');
        // $responseHeaders->set('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
        // $responseHeaders->set('Access-Control-Max-Age: 1000');

        // $headers = getallheaders();
    }
}
