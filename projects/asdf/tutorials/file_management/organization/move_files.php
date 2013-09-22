<h1>Moving Files</h1>
<p>
If you want to move a file instead of copying it, 
the command is <span style="font-family:courier;">
mv [filename1] [filename2]</span>.  You 
can use it with the exact same techniques that you 
know for cp.  The only difference is that it will 
move the file instead of copying.
</p>
<div class="shellwindow">
server{username}: ls<br />
Original.txt&nbsp;&nbsp;&nbsp;Copied.txt<br />
server{username}: mv Copied.txt ../.<br />
server{username}: ls<br />
Original.txt<br />
server{username}: cd..<br />
server{username}: ls<br />
Example_Dir&nbsp;&nbsp;&nbsp;Original.txt&nbsp;&nbsp;&nbsp;Copied.txt<br />
server{username}: <span style="text-color:white;">|</span>
</div>

&nbsp;<br />
