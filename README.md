# vite-php
# Topページ php

これはviteとphpを連携したサンプルです。

## 動作手順

- `npm install`
- `composer install`
- `composer update`
- `npm run watch`  
  assetsフォルダとnestedフォルダ、index.phpを監視していて、変更があるとビルドされるようにしている。  
  phpファイルなので画面リロードは走らない（サーバーサイドで動作する言語なので）。
- `-S localhost:9000` で画面確認。  
  vite.config.jsでmanifest.jsonを生成しているので、phpファイルから読み込んでいる。

## package.json詳細

- `@vitejs/plugin-legacy`  
  Vite でのビルドプロセス中にレガシーブラウザ（古いブラウザ）向けの互換性を提供するためのプラグインです。このプラグインを使用すると、Vite はモダンブラウザとレガシーブラウザの両方で動作するアプリケーションを生成できます。  
  トランスパイル: 現代的なJavaScript（ES6+）を古いブラウザでも理解できる形式（通常はES5）にトランスパイルします。

- `autoprefixer` と `postcss`  
  CSSにおけるベンダープレフィックスを自動的に管理するためのツールです。Web開発においては、異なるブラウザ間でのスタイルの一貫性を保つためにベンダープレフィックスがしばしば必要になります。これらは、特定のブラウザの特定のバージョンでのみ機能するCSSプロパティに付けられる接頭辞です。

- `browser-sync`  
  ファイルが変更されたときに自動的にブラウザをリロードします。  
  phpファイルの場合は動かない。サーバーサイドのため。

- `nodemon`  
  `nodemon.json`  
  Node.js アプリケーションの開発を効率化するためのユーティリティツールです。主な機能は、ファイルシステム上の指定されたファイルやディレクトリの変更を監視し、変更があった場合に自動的にNode.jsアプリケーションを再起動することです。  
  このパッケージを使って、PHPファイルの変更を監視して、変更があった場合に自動的に本番環境用のビルドを走らせるようにしている。

## htmlではなく、phpファイルのみでviteコーディングするために関係している設定ファイル

- `package.json`
- `vite.config.js`（inputをmain: 'main.js'にした）
- `nodemon.json`（phpの時のみ必要）
- `composer.json`
- `composer.lock`
- `index.php`（manifest.jsonを読み込む記述が必要）
- `manifest.json`（vite.config.jsで生成されるように設定している）

## 参考

[参考サイト](https://flex-box.net/vite-for-coder/#co-index-0)
