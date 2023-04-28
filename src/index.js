import domReady from "@wordpress/dom-ready";
import { createRoot, render, createElement } from "@wordpress/element";
import { App } from "./app";

function composeApp() {
  const el = document.querySelector("#app");
  if (createRoot) {
    createRoot(el).render(createElement(App));
  } else {
    render(createElement(App), el);
  }
}

domReady(function () {
  composeApp();
});
