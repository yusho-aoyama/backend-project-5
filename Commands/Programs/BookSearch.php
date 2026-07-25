<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;

class BookSearch extends AbstractCommand
{
    // Aliases
    protected static ?string $alias = 'book-search';

    
    /**
     * このコマンドで使用できるオプションを定義する
     *
     * --isbn  : ISBNで検索
     * --title : タイトルで検索
     */
    public static function getArguments(): array
    {
         return [
            // isbn
            (new Argument('isbn'))
                ->description('Search for a book by ISBN.')
                ->required(false)
                ->allowAsShort(true),

            // title
            (new Argument('title'))
                ->description('Search for books by title.')
                ->required(false)
                ->allowAsShort(true),
        ];
    }


    public function execute(): int
    {
        $isbn = $this->getArgumentValue('isbn');
        $title = $this->getArgumentValue('title');

        // isbnとtitleが両方指定された場合はエラー
        if ($isbn !== false && $title !== false) {
            $this->log('Please use either --isbn or --title, not both.');

            return 1;
        }

        // isbnとtitleのどちらも指定されていない場合はエラー
        if ($isbn === false && $title === false) {
            $this->log('Please provide --isbn or --title.');

            return 1;
        }

        // isbnが指定されている場合
        if ($isbn !== false) {
            // ISBN検索用のキャッシュキーを作る
            $cacheKey = 'book-search-isbn-' . $isbn;

            $this->log("Searching by ISBN: {$isbn}");
            $this->log("Cache key: {$cacheKey}");

            return 0;
        }


        // ここまで来た場合はtitleが指定されている
        $cacheKey = 'book-search-title-' . $title;

        $this->log("Searching by title: {$title}");
        $this->log("Cache key: {$cacheKey}");

        return 0;
            
        }
}
