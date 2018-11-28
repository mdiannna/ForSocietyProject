# ForS0cietyProject

A web-based system for earthquake vulnerability prevention and assisting intervention teams

Video demo: https://youtu.be/tc3ciOce-MQ
## Description
ForS0ciety team addresses the problem of earthquakes from 3 perspectives: before the earthquake (Pre-EQ), during earthquake (Mid-EQ) and after earthquake (POST-EQ). 

The solution we developed before the earthquake consists in educating the population through short animation videos, built using Unity. 


The second stage, Mid-EQ, is monitored by adding the power of hardware sensors on buildings that are at the most risk. We created a device named Quakeuino, that uses Arduino and ESP8266 boards, gyroscope and accelerometer modules to collect data about buildings during an earthquake and notify the intervention teams and authorities about the damaged or even collapsed buildings. We plan to add the second way of detecting the damaged buildings - by using drones and Artificial Intelligence to compare images in the next stage of the project.

Finally, after the earthquake, in the Post-EQ stage, there are 4 main components developed by ForS0ciety team that help reduce the seismic risk. First of them is the Alert map, which makes use of the Google Maps API to help people send their location, needs and emergency type to the specialized intervention team. The data is then analyzed by using the IBM Natural Language Understanding module and then prioritized by analyzing emotion and sentiment and sent to intervention teams. The next part is the intelligent assistant provided by IBM Watson AI Conversation, which provides a more natural way to tell the needs and status. The last part is using open data to list the most recent earthquakes worldwide and specifically in Romania and help keep track of the seismic events.

## Project diagram
![Project diagram](https://raw.githubusercontent.com/mdiannna/ForSocietyProject/master/Project%20planning/forsociety_diagram.png)

## Authors - ForS0ciety Team
- **Cotov Anastasia** - *Hardware*
- **Popa Vlad** - *Web JavaScript and Watson AI*
- **Radoi Raluca** - *Research*
- **Dobre Marius** - *Animations and Graphics*
- **Marusic Diana** - *Web back-end and IBM NLU*


## Aknowledgements
Special thanks to mentors from the [Re:Rise NGO](http://rerise.org/) and IBM Romania

### Note
This is an app developed for the Call for Code event, intended to be developed in the future starting in Bucharest and extending worldwide
