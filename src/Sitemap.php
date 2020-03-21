<?php
declare(strict_types = 1);

namespace Nakatengga\SimpleSitemap;

use SimpleXMLElement;

/**
 * Class Sitemap
 * @package Nakatengga\SimpleSitemap
 */
class Sitemap
{
    /**
     * @var array
     */
    private $urls;

    /**
     * Sitemap constructor.
     * @param array $urls
     */
    public function __construct(array $urls = [])
    {
        $this->urls = $urls;
    }

    /**
     * @param string $url
     */
    public function add(string $url)
    {
        $this->urls[] = $url;
    }

    /**
     * @return string
     */
    public function generate(): string
    {
        /** @var SimpleXMLElement $sitemap */
        $sitemap = $this->getXmlTemplate();

        foreach ($this->urls as $loc) {
            $url = $sitemap->addChild('url');
            $url->addChild('loc', $loc);
        }

        return $sitemap->asXML();
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getXmlTemplate(): SimpleXMLElement
    {
        return simplexml_load_file(__DIR__ . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'xml-template.xml');
    }
}
