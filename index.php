<?php
// manifest.json ファイルを読み込む
$manifestFilePath = './dist/manifest.json';
$manifest = json_decode(file_get_contents($manifestFilePath), true);

// エントリーポイント 'main.js' に対応するアセットを取得
$mainJs = '';
$mainCss = '';
if (isset($manifest['main.js'])) {
    $mainJs = './dist/' . $manifest['main.js']['file'];

    // CSS ファイルのパスを取得（もし存在する場合）
    if (isset($manifest['main.js']['css'])) {
        foreach ($manifest['main.js']['css'] as $cssFile) {
            $mainCss = './dist/' . $cssFile;
            break; // 最初のCSSファイルだけを取得
        }
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vite App</title>
	<?php if ($mainCss): ?>
    <!-- スタイルシートを読み込む -->
    <link rel="stylesheet" href="<?php echo $mainCss; ?>">
    <?php endif; ?>
  </head>
  <body>
    <div id="app">
		<h1>Topページ php</h1>
		<p class="txt">これはviteとphpを連携したサンプルです</p>
		<p class="txt">masterにテキスト追加　masterを優先</p>
		<h2>動作手順</h2>
		<ul>
			<li>npm install</li>
			<li>composer install</li>
			<li>composer update</li>
			<li>npm run watch<br>
			assetsフォルダとnestedフォルダ、index.phpを監視していて、変更があるとビルドされるようにしている<br>
			phpファイルなので画面リロードは走らない（サーバーサイドで動作する言語なので）</li>
			<li>-S localhost:9000 で画面確認<br>
				vite.config.jsでmanifest.jsonを生成しているので、phpファイルから読み込むことができる</li>
			</li>
		</ul>
		<h2>package.json詳細</h2>
		<ul>
			<li>
			@vitejs/plugin-legacy<br>
			Vite でのビルドプロセス中にレガシーブラウザ（古いブラウザ）向けの互換性を提供するためのプラグインです。このプラグインを使用すると、Vite はモダンブラウザとレガシーブラウザの両方で動作するアプリケーションを生成できます。<br>
			トランスパイル: 現代的なJavaScript（ES6+）を古いブラウザでも理解できる形式（通常はES5）にトランスパイルします。
			</li>
			<li>
			autoprefixerとpostcss<br>
			CSSにおけるベンダープレフィックスを自動的に管理するためのツールです。Web開発においては、異なるブラウザ間でのスタイルの一貫性を保つためにベンダープレフィックスがしばしば必要になります。これらは、特定のブラウザの特定のバージョンでのみ機能するCSSプロパティに付けられる接頭辞です。
			</li>
			<li>
			browser-sync<br>
			ファイルが変更されたときに自動的にブラウザをリロードします
			phpファイルの場合は動かない。サーバーサイドのため
			</li>
			<li>
			nodemon<br>
			nodemon.json<br>
			Node.js アプリケーションの開発を効率化するためのユーティリティツールです。主な機能は、ファイルシステム上の指定されたファイルやディレクトリの変更を監視し、変更があった場合に自動的にNode.jsアプリケーションを再起動することです。<br>
			このパッケージを使って、PHPファイルの変更を監視して、変更があった場合に自動的に本番環境用のビルドを走らせるようにしている
			</li>
		</ul>
		<h2>htmlではなく、phpファイルのみでviteコーディングするために関係している設定ファイル</h2>
		<ul>
			<li>package.json</li>
			<li>vite.config.js（inputをmain: 'main.js'にした）</li>
			<li>nodemon.json（phpの時のみ必要）</li>
			<li>composer.json</li>
			<li>composer.lock</li>
			<li>index.php（manifest.jsonを読み込む記述が必要）</li>
			<li>manifest.json（vite.config.jsで生成されるように設定している）</li>
		</ul>

		<h2>参考</h2>
		<a href="https://flex-box.net/vite-for-coder/#co-index-0" target="_blank">参考サイト</a><br>
		<img class="img_sample" src="./assets/images/sample.jpeg" alt="">
	</div>
    <?php if ($mainJs): ?>
    <!-- JavaScript を読み込む -->
    <script type="module" src="<?php echo $mainJs; ?>"></script>
    <?php endif; ?>
  </body>
</html>
   