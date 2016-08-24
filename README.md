# Oswald Accessibility Widget

## Synopsis

Over the past few weeks, [Oswald Foundation](https://oswald.foundation) has been working on introducing a global accessibility standard for web designers and developers. This API is a one-line customizable backward-compatible (IE8+) solution to help implement accessibility features like Dyslexia-friendly mode and Dark mode in websites.

## Code Example

What's great about this API is how easy it is to implement. Add the following line of code before the `<body>` tag closes.
```
<p><button data-oswald>Accessibility</button></p>
<script src="https://oswald.foundation/developers/oswald.min.js"></script>
```

## Options

- Oswald looks for all elements matching `data-oswald` or class `oswald-service`. The accessibility service starts when a use clicks on any of these elements, which are typically links or buttons.
- It adds class `oswald-on` and `oswald-off` based on the service status on the aforementioned elements.

## Roadmap

These features should be coming soon:
- Custom/editable accessibility themes
- JS Methods for `oswald.start()` and more
- Custom theme colors, CSS for client UI

## Contribute

The development mode of this script contains as many comments as I could add, it's hosted at `https://oswald.foundation/developers/oswald.js`. Got an idea? Throw in a pull request and we'll merge. :)

## License

Copyright (c) 2016 Oswald Foundation | Anand Chowdhary and Nishant Gadihoke | hello@oswald.foundation

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
