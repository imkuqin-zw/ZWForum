<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/13
 * Time: 14:49
 */

namespace App\Zwforum\Markdown;

use League\HTMLToMarkdown\HtmlConverter;
use Parsedown;
use Purifier;
use ParsedownExtra;

class Markdown
{
    protected $htmlParser;
    protected $markdownParser;

    public function __construct()
    {
        $this->htmlParser = new HtmlConverter(['header_style' => 'atx']);
        $this->markdownParser = new Parsedown();
    }

    public function convertHtmlToMarkdown($html)
    {
        return $this->htmlParser->convert($html);
    }

    public function convertMarkdownToHtml($markdown)
    {
        $convertedHmtl = $this->markdownParser->setBreaksEnabled(true)->text($markdown);
        $convertedHmtl = Purifier::clean($convertedHmtl, 'user_topic_content');
        $convertedHmtl = str_replace("<pre><code>", '<pre><code class="language-php">', $convertedHmtl);

        return $convertedHmtl;
    }
}