<h1>SSH</h1>
<p>
Ok, now that we are done with the baby stuff, we are on to the 
real UNIX. FTP is nice, but if you really want to know what's 
happening you need to connect with SSH. It's not unheard of to 
accidentally click randomly in an FTP client and erase files 
that were not backed up. You can't do that when connecting 
via SSH.
</p>
<p>
If you are running a Windows computer, you will need to download a 
program to connect to UNIX. A very popular and free program is 
<a href="http://www.chiark.greenend.org.uk/~sgtatham/putty/">
Putty</a>. To use Putty just download and open it. Inside the 
red area on the screen shot below is all you really need to pay 
attention to. Enter the server name and the port number, and 
then click Open. 
<object>
<div style="text-align:center" >
	<a href="putty_big.jpg" style="font-size:8pt;padding:0;margin-right:10px;">
		<img style="border:0;" src="putty_small.jpg" alt="Putty connection screenshot" />
	</a>
	<a href="putty_username.jpg" style="font-size:8pt;padding:0;margin-left:10px;">
<img style="border:0;" src="putty_username.jpg" alt="Putty username screenshot" /></a></div>
</object>
A black window will pop up prompting you 
to <span style="font-family:courier;">login as:</span>. Enter your 
username and press enter.
</p>
<p>
If you are running a Linux or a Mac computer, you have a tool 
all ready for you to connect to UNIX with, called Terminal. 
If you are on a Mac, look in your Applications folder, then 
inside a folder called "Utilities", and you should find it. 
For Linux users, it is under Applications > Accessories > Terminal.
</p>
<p>
When you open the Terminal you will see what is called the prompt. 
This is your computer's way of saying "I'm here, what do you want 
me to do." Every command line based interface has a prompt of some 
sort. To connect to your UNIX server, type into the Terminal window 
"ssh username@servername". That's it. So, for example, if your username 
was Gates and your servername was bill.microsoft.com, you would type 
"ssh Gates@bill.microsoft.com".
</p>
<p>
Once you enter the username/username@server into the UNIX window (using either method), 
the server will then ask for your password. When you start typing
it in, you will not see it. This is for your security. You usually 
get 3 tries to get it right. When you are done hit "enter".  You 
should now get a prompt. If you are using the Terminal, this prompt 
will look different than the initial prompt your local computer 
gave you.
</p>
<p>
Congratulations, you have logged into UNIX!
</p>
