// vite.config.js
import { resolve } from 'path'
import { defineConfig } from 'vite'
import legacy from '@vitejs/plugin-legacy'
import viteImagemin from 'vite-plugin-imagemin';

export default defineConfig({
	base: './',
	build: {
		rollupOptions: {
			input: {
				main: resolve(__dirname, 'index.html'),
				nested: resolve(__dirname, 'nested/index.html'),
				kaso01: resolve(__dirname, 'blog/index.html'),
			},
			output: {
				// エントリーポイントごとのファイル出力設定
				entryFileNames: `assets/js/[name].[hash].js`,
				// チャンクファイル（非エントリーポイントのコード分割されたファイル）の設定
				chunkFileNames: `assets/js/[name].[hash].js`,
				// 動的インポートされるモジュールの設定
				assetFileNames: (assetInfo) => {
					if (assetInfo.name.endsWith('.css')) {
						return `assets/css/[name].[hash][extname]`;
					}
					// 画像やフォントなどのアセット
					return `assets/images/[name].[hash][extname]`;
				}
			}
		},
	},
	plugins: [
		legacy({
			targets: ['ie >= 11'],
			additionalLegacyPolyfills: ['regenerator-runtime/runtime']
		}),
		/* viteImagemin({
			gifsicle: {
				optimizationLevel: 7,
				interlaced: false,
			},
			optipng: {
				optimizationLevel: 7,
			},
			mozjpeg: {
				quality: 75,
				// EXIFデータを保持するオプションを追加
				//preserve: true
			},
			mozjpg: {
				quality: 75,
				// EXIFデータを保持するオプションを追加
				preserve: true
			},
			pngquant: {
				quality: [0.8, 0.9],
				speed: 4,
				strip: false
			},
			svgo: {
				plugins: [
					{
						name: 'removeViewBox',
					},
					{
						name: 'removeEmptyAttrs',
						active: false,
					},
				],
			},
		}), */
	],
})