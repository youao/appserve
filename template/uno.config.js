import presetWind4 from "@unocss/preset-wind4";
import presetAttributify from "@unocss/preset-attributify";
import presetTagify from "@unocss/preset-tagify";
import { defineConfig } from "unocss";

export default defineConfig({
  presets: [
    presetWind4({
      preflights: {
        reset: true,
      },
    }),
    presetAttributify({
      prefix: "un-",
    }),
    presetTagify(),
  ],
});
