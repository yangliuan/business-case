<?php

namespace App\Http\Controllers\Doc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DOMDocument;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use App\Traits\SaveBase64Image;

class WordController extends Controller
{
    use SaveBase64Image;

    public function wordConvertHtml(Request $request)
    {
        $request->validate([
            'word' => [
                'bail', 'required', 'file',
                'mimetypes:application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/wps-office.docx'
            ]
        ]);

        $pathInfo = pathinfo($request->word->getClientOriginalName());

        $extentsion = $request->file('word')->extension();

        if ($extentsion == 'doc') {
            $readerName = 'MsDoc';
        } else {
            $readerName = 'Word2007';
        }

        $path = $request->file('word')->storeAs('word', time() . '.' . $extentsion, 'public');

        $realPath = storage_path('app/public/' . $path);

        $word = IOFactory::load($realPath, $readerName);

        $write = IOFactory::createWriter($word, 'HTML');

        $htmlDom = new DOMDocument();

        $htmlDom->loadHTML($write->getContent());

        $images = $htmlDom->getElementsByTagName('img');

        //将base64图片保存成文件存到本地
        foreach ($images as $key => $image) {
            $image->setAttribute('src', $this->save($image->getAttribute('src')));
        }

        $body = $htmlDom->getElementsByTagName('body')->item(0);

        $content = $htmlDom->saveHTML($body);

        $content = str_replace(['<body>', '</body>'], '', $content);

        return $content;
    }

    public function htmlConvertWord(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $response = Http::get($request->input('url'));

        if ($response->failed()) {
            return '抓取失败';
        }

        $html = $response->body();
        //dd($html);
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        @$doc->loadHTML($html);
        $htmlContent = $doc->saveHTML();
        dd($htmlContent);

        $phpword = new PhpWord();
        $section = $phpword->addSection();
        Html::addHtml($section, $htmlContent, true, true);

        return $phpword->save(storage_path('word/' . time() . '.docx'), 'Word2007', true);
    }
}
