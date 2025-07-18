import { defineConfig } from "unocss";
import presetWind4 from "@unocss/preset-wind4";
import presetAttributify from "@unocss/preset-attributify";
import presetTagify from "@unocss/preset-tagify";
import transformerDirectives from "@unocss/transformer-directives";
import presetIcons from '@unocss/preset-icons'

export default defineConfig({
  presets: [
    presetWind4({
      preflights: {
        reset: true
      }
    }),
    presetAttributify({
      prefix: "un-"
    }),
    presetTagify(),
    presetIcons()
  ],
  transformers: [transformerDirectives()]
});
