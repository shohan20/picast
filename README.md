# Picast
Picast is a photo sharing website where people can easily organize images and albums. Whenhub api is used so that people can easily organize and cast their albums in whencast.
# Features
<ul >
        <li >personal user account</li>
        <li >user friendly interface</li>
        <li>upload multiple photos at a time</li>
        <li >update, delete and sharing facilities</li>
        <li>photo download, zoom & Fullscreen</li>
        <li >search photos by user, caption or date in public interface</li>
        <li >share photos via different social media (Facebook, Twitter, Googleplus, Pinterest) </li>
        <li >can load different images for different viewports and can display high resulation images</li>
        <li >photo captions and locations are easily editable </li>
        <li >personal and public interfaces for both gallery and album</li>
        <li >use of whenhub api to create and organize whenhub-album</li>
        <li >whenhub users can easily organize their albums through picast</li>
        <li >whenhub-albums can be shared, deleted and organized via picast</li>
        <li >multiple images can be uploaded and deleted in each of the whenhub-albums</li>
        <li >users can update name, caption, time and location of whenhub-albums and photos</li>
        <li >one can follow other users' shared albums and photos</li></ul>
        
# Prerequisites
<ul class="list-group">
        <li class="list-group-item">you have to open an account for organizing your photos</li>
        <li class="list-group-item">A whenhub access token is needed to create and organize your whenhub albums </li> </ul>
    
# How I built it
I have used php, javascript, bootstrap, jquery, mysql, ajax and some opensource libraries to develop this application. Whenhub API has been used to create, delete, upload and organize users' albums and photos. Picast ask user "whenhub access token" for creating a schedule named Picast-Albums.  Users can create multiple albums(events) in that created schedule of whenhub and can add photos(media in whenhub events)  to their albums. Picast is made user friendly. Update, delete, edit and sharing facilities have been included along with the options of following other users' photos and albums.

# How whenhub API has been used
<ul>
<li><strong>Create a schedule:</strong> create a directory to preserve all the picast albums of a user with 'name', 'when', 'description' and 'createdBy'</li>
<li><strong>Create an event:</strong> create picast album with 'name', 'description', 'location', 'when' and 'createdBy' </li>
<li><strong>Add an image to a event:</strong> add images to picast album with 'name', 'description', 'createdAt' and 'url' </li>
<li><strong>Update an Event:</strong> to update the album's' name', 'description', 'location', 'when', 'updatedAt' and also to remove and update image's info in media </li>
<li><strong>Remove an event:</strong> delete the album</li>
<li><strong>Schedules with events and media:</strong>  get the albums' and photos' info </li></ul>   

# Challenges I ran into
At first I have faced some problems in implementing whenhub API. I am very thankful that "Whenhub Support"  has helped me to solve those problems. Picast is one of my first web-apps. So, I had to learn different web languages and their formats from the beginner level. And due to limited time I couldn't implement some more features.

# Accomplishments that I'm proud of
Picast will help people to share and whencast their dreams and memories. And after a long time they will be cherished with their preserved albums in the picast.

# What I learned
<ul >
        <li >php</li>
        <li >bootstrap</li>
        <li>ajax</li>
        <li >javascript</li>
 <li >jquery</li>
 <li >whenhub API</li></ul>

# What's next for Picast
<ul>
<li> transfer photos and albums into inter-schedules in whenhub</li>
<li>image searching using machine learning</li>
<li>image processing </li>
<li>more user friendly interface (collage, animation etc)</li>
<li>more socializable</li></ul>

# Demo 
https://youtu.be/mo_7tPvQ4L0
# Website
http://picast.azurewebsites.net/
