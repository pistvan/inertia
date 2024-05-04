import globals from "globals";
import pluginJs from "@eslint/js";
import tseslint from "typescript-eslint";
import pluginVue from "eslint-plugin-vue";
import vueeslint from 'vue-eslint-parser';


export default [
  {languageOptions: { globals: globals.browser }},
  pluginJs.configs.recommended,
  ...tseslint.configs.recommended,
  ...pluginVue.configs["flat/essential"],
  {
    languageOptions: {
      parser: vueeslint,
      parserOptions: {
        parser: "@typescript-eslint/parser",
        extraFileExtensions: [".vue"]
      },
    },
  },
  {
    rules: {
        'vue/multi-word-component-names': 'off',
    },
  },
  {
    // https://typescript-eslint.io/troubleshooting/#i-get-errors-from-the-no-undef-rule-about-global-variables-not-being-defined-even-though-there-are-no-typescript-errors
    files: ['**/*.{ts,tsx,mts,cts,vue}'],
    rules: {
      'no-undef': 'off',
    },
  }
];
