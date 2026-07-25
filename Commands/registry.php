<?php 

// 利用可能なコマンドのリストを保持しています。
// ここで定義されているコマンドクラスが、コンソールアプリケーションで使用できる

return [
    Commands\Programs\Migrate::class,
    Commands\Programs\CodeGeneration::class,
    Commands\Programs\DbWipe::class,
];