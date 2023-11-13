<?php
// manifest.json ファイルを読み込む
$manifestFilePath = './../dist/manifest.json';
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
		<h1>下層ページ</h1>
	</div>
    <?php if ($mainJs): ?>
    <!-- JavaScript を読み込む -->
    <script type="module" src="<?php echo $mainJs; ?>"></script>
    <?php endif; ?>
  </body>
</html>
   