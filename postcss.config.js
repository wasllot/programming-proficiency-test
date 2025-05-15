// Deshabilita el uso nativo de LightningCSS
process.env.LIGHTNING_CSS_DISABLE_NATIVE = "1";

module.exports = {
  plugins: {
    '@tailwindcss/postcss': {},
    autoprefixer: {},
  },
};
