<h1>Navigating Directories</h1>
<p>
Whenever you see a directory in your list, you're on a level 
above that directory.  To move down a level into the directory 
you've created, type "cd (directory name)".  cd (stands for 
"change directory"), moves you around in UNIX.
</p>
<p>
Now that you're in the directory you created, enter "pwd" 
(print working directory) to see the path from your home 
directory to the directory you're in now.
</p>

<div class="shellwindow">
server{username}: ls<br />
Example_Dir<br />
server{username}: cd Example_dir<br />
server{username}: pwd<br />
/home/username/examples/Example_dir<br />
server{username}: <span style="text-color:white;">|</span>
</div>

<p>
There are three special symbols in UNIX that are important 
to know for navigation.  The first is ".", which refers to 
the directory you're currently in.  ".." points to the 
directory above the current one, also referred to as the 
parent directory.  Therefore, "cd .." takes you one 
directory up in the list.  Finally, "~" refers to your 
personal directory (which for me, is username).  You can use 
~ with cd to quickly return to your home directory.
</p>
<p>
Also note that you can create a chain of directories 
with cd to move through multiple layers of folders quickly.  
As shown below, I can get from my home directory to 
Example_Dir by entering "cd examples/Example_Dir".
</p>

<div class="shellwindow">
server{username}: pwd<br />
/home/username/examples/Example_dir<br />
server{username}: cd .<br />
server{username}: pwd<br />
/home/username/examples/Example_dir<br />
server{username}: cd ..<br />
server{username}: pwd<br />
/home/username/examples<br />
server{username}: cd ~<br />
server{username}: pwd<br />
/home/username<br />
server{username}: cd examples/Example_dir<br />
server{username}: pwd<br />
/home/username/examples/Example_dir<br />
server{username}: <span style="text-color:white;">|</span>
</div>

<p>
As you only have your home directory and the directory 
we made at the beginning of the tutorial, feel free to 
make more directories and practice navigating 
around before moving on.
</p>
&nbsp;<br />

