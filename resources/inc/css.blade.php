    <style>
      /*! normalize.css v8.0.0 | MIT License | github.com/necolas/normalize.css */

    /* Document
       ========================================================================== */

    /**
     * 1. Correct the line height in all browsers.
     * 2. Prevent adjustments of font size after orientation changes in iOS.
     */

    html {
      line-height: 1.15; /* 1 */
      -webkit-text-size-adjust: 100%; /* 2 */
    }

    /* Sections
       ========================================================================== */

    /**
     * Remove the margin in all browsers.
     */

    body {
      margin: 0;
    }

    /**
     * Correct the font size and margin on `h1` elements within `section` and
     * `article` contexts in Chrome, Firefox, and Safari.
     */

    h1 {
      font-size: 2em;
      margin: 0.67em 0;
    }

    /* Grouping content
       ========================================================================== */

    /**
     * 1. Add the correct box sizing in Firefox.
     * 2. Show the overflow in Edge and IE.
     */

    hr {
      box-sizing: content-box; /* 1 */
      height: 0; /* 1 */
      overflow: visible; /* 2 */
    }

    /**
     * 1. Correct the inheritance and scaling of font size in all browsers.
     * 2. Correct the odd `em` font sizing in all browsers.
     */

    pre {
      font-family: monospace, monospace; /* 1 */
      font-size: 1em; /* 2 */
    }

    /* Text-level semantics
       ========================================================================== */

    /**
     * Remove the gray background on active links in IE 10.
     */

    a {
      background-color: transparent;
    }

    /**
     * 1. Remove the bottom border in Chrome 57-
     * 2. Add the correct text decoration in Chrome, Edge, IE, Opera, and Safari.
     */

    abbr[title] {
      border-bottom: none; /* 1 */
      text-decoration: underline; /* 2 */
      text-decoration: underline dotted; /* 2 */
    }

    /**
     * Add the correct font weight in Chrome, Edge, and Safari.
     */

    b,
    strong {
      font-weight: bolder;
    }

    /**
     * 1. Correct the inheritance and scaling of font size in all browsers.
     * 2. Correct the odd `em` font sizing in all browsers.
     */

    code,
    kbd,
    samp {
      font-family: monospace, monospace; /* 1 */
      font-size: 1em; /* 2 */
    }

    /**
     * Add the correct font size in all browsers.
     */

    small {
      font-size: 80%;
    }

    /**
     * Prevent `sub` and `sup` elements from affecting the line height in
     * all browsers.
     */

    sub,
    sup {
      font-size: 75%;
      line-height: 0;
      position: relative;
      vertical-align: baseline;
    }

    sub {
      bottom: -0.25em;
    }

    sup {
      top: -0.5em;
    }

    /* Embedded content
       ========================================================================== */

    /**
     * Remove the border on images inside links in IE 10.
     */

    img {
      border-style: none;
    }

    /* Forms
       ========================================================================== */

    /**
     * 1. Change the font styles in all browsers.
     * 2. Remove the margin in Firefox and Safari.
     */

    button,
    input,
    optgroup,
    select,
    textarea {
      font-family: inherit; /* 1 */
      font-size: 100%; /* 1 */
      line-height: 1.15; /* 1 */
      margin: 0; /* 2 */
    }

    /**
     * Show the overflow in IE.
     * 1. Show the overflow in Edge.
     */

    button,
    input { /* 1 */
      overflow: visible;
    }

    /**
     * Remove the inheritance of text transform in Edge, Firefox, and IE.
     * 1. Remove the inheritance of text transform in Firefox.
     */

    button,
    select { /* 1 */
      text-transform: none;
    }

    /**
     * Correct the inability to style clickable types in iOS and Safari.
     */

    button,
    [type="button"],
    [type="reset"],
    [type="submit"] {
      -webkit-appearance: button;
    }

    /**
     * Remove the inner border and padding in Firefox.
     */

    button::-moz-focus-inner,
    [type="button"]::-moz-focus-inner,
    [type="reset"]::-moz-focus-inner,
    [type="submit"]::-moz-focus-inner {
      border-style: none;
      padding: 0;
    }

    /**
     * Restore the focus styles unset by the previous rule.
     */

    button:-moz-focusring,
    [type="button"]:-moz-focusring,
    [type="reset"]:-moz-focusring,
    [type="submit"]:-moz-focusring {
      outline: 1px dotted ButtonText;
    }

    /**
     * Correct the padding in Firefox.
     */

    fieldset {
      padding: 0.35em 0.75em 0.625em;
    }

    /**
     * 1. Correct the text wrapping in Edge and IE.
     * 2. Correct the color inheritance from `fieldset` elements in IE.
     * 3. Remove the padding so developers are not caught out when they zero out
     *    `fieldset` elements in all browsers.
     */

    legend {
      box-sizing: border-box; /* 1 */
      color: inherit; /* 2 */
      display: table; /* 1 */
      max-width: 100%; /* 1 */
      padding: 0; /* 3 */
      white-space: normal; /* 1 */
    }

    /**
     * Add the correct vertical alignment in Chrome, Firefox, and Opera.
     */

    progress {
      vertical-align: baseline;
    }

    /**
     * Remove the default vertical scrollbar in IE 10+.
     */

    textarea {
      overflow: auto;
    }

    /**
     * 1. Add the correct box sizing in IE 10.
     * 2. Remove the padding in IE 10.
     */

    [type="checkbox"],
    [type="radio"] {
      box-sizing: border-box; /* 1 */
      padding: 0; /* 2 */
    }

    /**
     * Correct the cursor style of increment and decrement buttons in Chrome.
     */

    [type="number"]::-webkit-inner-spin-button,
    [type="number"]::-webkit-outer-spin-button {
      height: auto;
    }

    /**
     * 1. Correct the odd appearance in Chrome and Safari.
     * 2. Correct the outline style in Safari.
     */

    [type="search"] {
      -webkit-appearance: textfield; /* 1 */
      outline-offset: -2px; /* 2 */
    }

    /**
     * Remove the inner padding in Chrome and Safari on macOS.
     */

    [type="search"]::-webkit-search-decoration {
      -webkit-appearance: none;
    }

    /**
     * 1. Correct the inability to style clickable types in iOS and Safari.
     * 2. Change font properties to `inherit` in Safari.
     */

    ::-webkit-file-upload-button {
      -webkit-appearance: button; /* 1 */
      font: inherit; /* 2 */
    }

    /* Interactive
       ========================================================================== */

    /*
     * Add the correct display in Edge, IE 10+, and Firefox.
     */

    details {
      display: block;
    }

    /*
     * Add the correct display in all browsers.
     */

    summary {
      display: list-item;
    }

    /* Misc
       ========================================================================== */

    /**
     * Add the correct display in IE 10+.
     */

    template {
      display: none;
    }

    /**
     * Add the correct display in IE 10.
     */

    [hidden] {
      display: none;
    }

    @font-face {
        font-family: nrml;
        src: url(../fonts/nrml.ttf);
    }

    @font-face {
        font-family: bld;
        src: url(../fonts/bld.ttf);
    }

    @font-face {
        font-family: gogo;
        src: url(../fonts/gogo.ttf);
    }

    @font-face {
        font-family: english;
        src: url(../fonts/english.ttf);
    }

    html {
      font-size: 16px;
      margin: 0;
      height: 100%;
    }

    body {
      background-color: #fafafa;
      border-top: 200px solid #7986cb;
      margin: 0;
      height: 100%;
    }

    .grid {
      display: grid;
      grid-template-columns: 1fr repeat(10, 90px) 1fr;
      grid-gap: 20px;
      padding: 15px 0px;
    }

    .item {
      grid-column: 2 / 12;
      background-color: #4180AB;
      border-radius: 3px;
      padding: 15px;
      color: white;
      display: grid;
      grid-template-columns: 1fr 60px;
      align-items: center;
      box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
      position: relative;
    }

    .form {
      grid-column: 2 / 12;
      background-color: white;
      padding: 15px;
      color: #616161;
      border-radius: 3px;
      font-family: gogo;
      font-size: 1.2rem;
      margin-top: -150px;
      border: 10px solid #7986cb;
    }

    .form h1 {
      font-weight: 400;
      font-size: 2rem;
      font-family: bld;
      margin: 0;
      margin-bottom: 10px;
    }

    .form button {
      margin-top: 10px;
      float: right;
      padding: 0.4em 0.8em 0.3em 0.8em;
      background-color: #8e24aa;
      color: white;
      font-family: nrml;
      border-radius: 3px;
      cursor: pointer;
      border: 0 none;
      box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
    }

    .form textarea {
      display: block;
      width: 100%;
      padding: 10px;
      box-sizing: border-box;
      resize: vertical;
      border-radius: 3px;
    }

    .item:nth-child(2n){
      background-color: #D4910B;
    }

    .upvote,
    .downvote {
      height: 35px;
      width: auto;
      display: block;
      cursor: pointer;
      transition: fill 250ms;
      fill: white;
    }

    .downvote.active {
      fill: #303f9f;
    }

    .upvote.active {
      fill: #e53935;
    }

    .voting {
      display: flex;
      flex-direction: column;
    }

    span {
      display: block;
      text-align: center;
      font-family: english;
      font-weight: 900;
    }

    .content p {
      font-family: gogo;
      font-size: 1rem;
      line-height: 1.5rem;
    }

    .content p::before {
      content: "\201C \0020 \201D";
      display: block;
      font-size: 3rem;
      text-shadow: 2px 2px rgba(0,0,0,0.4);
    }

    @media only screen and (max-width: 1150px) {
      .grid {
        grid-template-columns: repeat(12, 1fr);
        padding: 15px;
      }

      .item-reply,
      .item {
        grid-column: 1 / -1;
      }

      .form {
        grid-column: 1 / -1;
      }
    }

    .notification.success {
      background-color: #9ccc65;
    }

    .notification.fail {
      background-color: #e53935;
    }

    .notification {
      position: fixed;
      top: 0;
      height: 50px;
      color: white;
      width: 100%;
      box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
      font-family: bld;
      overflow: hidden;
      z-index: 99;
      transition: height 250ms;
    }

    .notification h1 {
      position: fixed;
      top: -7px;
      right: 15px;
      font-size: 1.5rem;
      font-family: english;
      cursor: pointer;
    }

    .notification p {
      text-align: center;
      padding: 0px 40px;
    }

    .content p a {
      text-decoration: none;
      color: #4a148c;
      word-break: break-all;
    }

        .refresh-svg {
      height: 30px;
      fill: white;
      cursor: pointer;
      transition: fill 250ms;
    }

    .refresh-svg:hover {
      fill: #ef9a9a;
    }

    .refresh {
      position: absolute;
      top: 20px;
      right: 20px;
    }

    .content p a {
      text-decoration: none;
      color: #4a148c;
    }

    .sorting {
      position: absolute;
      top: 20px;
      left: 20px;
    }
     
    .new-sort {
      height: 30px;
      fill: white;
      padding-left: 30px;
      transition: fill 250ms;
    }
     
    .hot-sort {
      height: 30px;
      fill: #f9a825;
      transition: fill 250ms;
    }
     
    .hot-sort:hover {
      fill: #f57f17;
    }
     
    .new-sort:hover {
      fill: #f5f5f5;
    }

    .reply-svg,
    .author-svg {
      height: 25px;
      fill: white;
    }
     
    .reply-svg {
      padding-left: 15px;
    }
     
    .author h3 {
      font-family: english;
      font-weight: 400;
      display: inline-block;
      text-align: center;
      font-size: 0.75rem;
      margin: 0;
      padding: 0 10px;
    }
     
    .author {
      display: flex;
      align-items: center;
    }
     
    .item-reply {
      grid-column: 2 / 12;
      background-color: #4180AB;
      border-radius: 3px;
      margin-left: 30px;
      padding: 15px;
      color: white;
      display: grid;
      grid-template-columns: 1fr 60px;
      align-items: center;
      box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
      position: relative;
    }
     
    .item-reply:nth-child(2n){
      background-color: #D4910B;
    }

    .author a {
      color: #4a148c;
    }

    @media only screen and (min-width: 1150px) {
      .downvote:hover {
        fill: #303f9f;
      }

      .upvote:hover {
        fill: #e53935;
      }
    }
  </style>