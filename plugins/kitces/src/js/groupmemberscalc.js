!function(e){var t={};function r(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=e,r.c=t,r.d=function(e,t,n){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)r.d(n,o,function(t){return e[t]}.bind(null,o));return n},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="",r(r.s=6)}({19:function(e,t,r){"use strict";r.r(t);var n=e=>null==e||0===e.length;var o=()=>new Promise(e=>{try{const t=document.querySelector(".group-intake .gform_footer");if(!n(t)){const r=document.createElement("div");r.classList.add("member-calculator"),r.setAttribute("id","member-calculator"),t.before(r);const n=document.createElement("span");n.classList.add("member-label"),n.setAttribute("id","member-label"),n.innerHTML="Estimated Total: ",r.appendChild(n);const o=document.createElement("span");o.classList.add("member-total"),o.setAttribute("id","member-total"),n.appendChild(o);const a=document.createElement("span");a.classList.add("member-savings"),a.setAttribute("id","member-savings"),a.setAttribute("style","margin-left: 2rem;"),a.innerHTML="Savings: ",r.appendChild(a);const s=document.createElement("span");s.classList.add("member-savings-total"),s.setAttribute("id","member-savings-total"),a.appendChild(s),setTimeout(async()=>{e()})}}catch(e){console.error(e)}});var a=async e=>new Promise(t=>{try{const r=document.querySelectorAll(".gpnf-nested-entries tr");if(!n(r))for(let t=0;t<r.length;t++)r[t].hasAttribute("data-entryid")&&e++;t(e)}catch(e){console.error(e)}});var s=async(e,t)=>new Promise(r=>{try{setTimeout(()=>{if("gpnf-add-entry"===e.target.className){document.querySelector(".tingle-modal-box").querySelector(".gpnf-btn-submit").addEventListener("click",()=>{t++,r(t)})}"delete"===e.target.parentNode.className&&(t--,r(t))})}catch(e){console.error(e)}});var c=e=>{let t;const{prices:r}=kitcesGroupPricing;switch(!0){case 1===e:t=Number(r[0]);break;case e>=2&&e<=4:t=Number(r[1]);break;case e>=5&&e<=15:t=Number(r[2]);break;case e>=16&&e<=50:t=Number(r[3]);break;default:t=0}return e*t};var i=()=>{const e=document.getElementById("group-price-quote-total"),t=document.getElementById("group-price-quote-select"),r=document.getElementById("group-price-quote-cost"),o=document.getElementById("group-price-quote-limit");if(n(r)||(r.style.display="block"),n(o)||(o.style.display="none"),!n(e)){let a=t.options[t.selectedIndex].value;e.innerHTML=c(Number(a)),n(t)||t.addEventListener("change",t=>{a=t.target.options[t.target.selectedIndex].value,"50+"===a?(n(r)||(r.style.display="none"),n(o)||(o.style.display="block")):e.innerHTML=c(Number(a))})}};(async()=>{await o();const e=document.getElementById("member-total"),t=document.getElementById("member-savings-total");if(!n(e)){let r=1;r=await a(r),e.innerHTML=`$${c(Number(r))}.00`,t.innerHTML=`$${149*Number(r)-c(Number(r))}.00`,document.body.addEventListener("click",async n=>{r=await s(n,r),e.innerHTML=`$${c(Number(r))}.00`,t.innerHTML=`$${149*Number(r)-c(Number(r))}.00`})}})(),i()},6:function(e,t,r){e.exports=r(19)}});