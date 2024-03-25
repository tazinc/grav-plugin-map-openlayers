import { nodeResolve } from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';
// import inject from '@rollup/plugin-inject';
import terser from '@rollup/plugin-terser';
import clean from '@rollup-extras/plugin-clean';
import babel from '@rollup/plugin-babel';
import typescript from '@rollup/plugin-typescript';
import scss from 'rollup-plugin-scss';
import postcss from 'postcss';
import autoprefixer from 'autoprefixer';
import cssnano from 'cssnano';
import compiler from '@ampproject/rollup-plugin-closure-compiler';

export default {
  input: "js/openlayers.ts",
  output: {
    dir: "assets",
    format: 'umd',
    name: 'ol',
    assetFileNames: '[name][extname]',
    // hashCharacters: "base36",
    // chunkFileNames: "[name]-[hash:22].js",
    // assetFileNames: "[name]-[hash][extname]",
    // manualChunks: (id) => {
    //   if (id.includes("node_modules")) {
    //     return "vendor";
    //   }

    // //   for (const chunk in config) {
    // //     const modules = config[chunk];
    // //     for (const name in modules) {
    // //       if (id.includes(modules[name].module)) {
    // //         return chunk;
    // //       }
    // //     }
    // //   }
    // },
  },
  plugins: [
    nodeResolve(),
    commonjs(),
    // inject({
    //   $j: "jquery",
    // }),
    terser(),
    clean({deleteOnce: true}),
    babel({
      babelHelpers: "bundled",
      exclude: "node_modules/**",
      presets: [["@babel/preset-env"]],
    }),
    typescript({ compilerOptions: {lib: ["es6", "dom"], target: "es6"}}),
    scss({
        fileName: 'openlayers.css',
        processor: () => postcss([autoprefixer(), cssnano({ preset: 'default' })]),
    }),
    // compiler(),
  ],
};
