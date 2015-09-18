<!------------------------------------------------ 
ATTENTION!
--------------------------------------------------
All you need for this Sticky Footer to work 
is a wrapper or container div (containing both
the content & footer), a content div (containing
whatever you want), & a footer div (make sure it
is outside of the content div, but inside the
wrapper or container div). In other words this:

<body>
    <div id="wrapper">
        <div id="content">Hello</div>
        <div id="footer"></div>
    </div>
</body>

is all you really need. I just added the h1, ul,
& descriptions to give this fiddle a little 
context & make it look pretty.
------------------------------------------------->

<?
	
	
?>

<body>
  
            <h1>The Perfect Sticky Footer</h1>
            <ul>
                <li>It sticks to the bottom of any window, especially when there isn't enough content to fill the screen!</li>
                <li>It doesn't overlap content! Unlike most fixed and absolutely positioned footers, this one stops at the bottom of the content & the scroll bar kicks in!</li>
                <li>It's purely HTML & CSS, no javascript required!</li>
                <li>It should work in all browsers, but don't quote me on that I haven't been able to test it in IE yet!</li>
                <li>Try resizing this window!</li>
            </ul>
			
        </div>
        <div id="footer">
        </div>
    </div>
</body>