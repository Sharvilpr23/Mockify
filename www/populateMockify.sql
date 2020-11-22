/**********************************************************************************************
					Populating the Tables
***********************************************************************************************/
use Mockify;

insert into Mockify.Song(songid,songname, duration, listencount, albumid) values 
(1,'Cliffy','3.48',2500,1), 
(2,'Mr. Rattlebone','4.14',1000,1),
(3,'Hallucinogenics','3.05',56643,1),
(4,'Unconditional','4.29',8725,1),
(5,'Thunder','3.25',10023,2), 
(6,'Natural','3.09',23400,2),
(7,'Bad Liar','4.20',13455,2),
(8,'Zero','3.30',7245,2),
(9,'Cool Out','3.37',62456,2),
(10,'Machine','3.01',12345,2), 
(11, 'Paradise','3.01',29324,3),
(12,'Charlie Brown','4.45',72455,3),
(13,'Mylo Xyloto','0.43',672345,3),
(14,'Hurts Like Heaven','4.02',72455,3),
(15,'Perth','4.22',74322,4),
(16,'Holocene','5.26',23567,4),
(17,'Towers','3.08',923,4),
(18,'Michicant','3.45',1345,4),
(19,'Calgary','4.10',853,4),
(20,'The A Team','4.21',67452,5),
(21,'Drunk','3.19',14537,5),
(22,'Grade 8','3.01',75142,5);

insert into Mockify.Artist(artistid,artistname) values 
(1,'Matt Maeson'), 
(2,'Imagine Dragons'), 
(3,'Coldplay'),
(4,'Bon Iver'),
(5,'Ed Sheeran');

insert into Mockify.Playlist(playlistid, userid, playlistname) values (1,1,'Chill Vibes'), (2,1,'Workout'), (3,2,'Study');

insert into Mockify.ArtistAlbum(artistid,albumid) values (1,1), (2,2), (3,3),(4,4),(5,5);

insert into Mockify.PlaylistSong(playlistid,songid) values (1,1), (1,2),(1,4),(1,5), (2,2), (2,3),(2,6), (3,3), (3,5),(3,6),(3,7),(3,12),(3,15),(3,22);

insert into Mockify.Follower(userid,artistid) values (1,2), (4,3), (5,2), (6,1);


