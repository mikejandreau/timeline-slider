# Timeline Slider
WordPress plugin that creates a horizontal timeline using the title, excerpt, and link from your list of posts.

To use it, add the shortcode `[timeline_slider]` to the content area in WordPress and save.

I haven't found a good way to do this yet programmatically, but if you want to add a link back to the main timeline, you can do so by adding a link to the bottom of the custom post type like so: 

```html
<!-- Content area of your post -->
<p>Here's some post content, blah blah.</p>
<p>Some more content, and return link goes below like so:</p>
<a class="timeline-return" href="/your-timeline-url/">Back to Timeline</a>
```

Adding the class "timeline-return" will ensure that the link will show up in single event pages and not on the main timeline page. Change the <code>href</code> to point to whatever page you've set to be the main timeline page.



