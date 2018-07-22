import numpy as np
from graphics import *

from math import sin, cos, radians

win = GraphWin('Hello', 1000, 1000)
win.yUp()


theta = 35.26
phi = 45

cube = np.matrix([
					[0,0,0], 
					[100,0,0],
					[100,100,0],
					[0,100,0], 
					[0,0,100], 
					[100,0,100],
					[100,100,100],
					[0,100,100], 
				])

cube = cube.getT()

print cube

isometric = np.matrix([
						[cos(radians(phi)),sin(radians(phi))*sin(radians(theta)),0.0],
						[0.0,cos(radians(theta)),0.0],
						[sin(radians(phi)),-(cos(radians(phi))*sin(radians(theta))),0.0]

					])
# print isometric

projectIsometric =  np.dot(isometric,cube)

print projectIsometric

points = []

for x in range(8):
	# print round(projectIsometric.item(x),2), round(projectIsometric.item(x+8),2)
	point = Point(round(projectIsometric.item(x),2), round(projectIsometric.item(x+8),2)+500)
	point.draw(win)
	points.append(point)


line1 = Line(points[0],points[4])
line2 = Line(points[0],points[3])
line3 = Line(points[2],points[3])
line4 = Line(points[3],points[1])
line5 = Line(points[4],points[1])
line6 = Line(points[5],points[6])
line7 = Line(points[6],points[1])
line8 = Line(points[5],points[4])
line9 = Line(points[6],points[2])
line1.draw(win)
line2.draw(win)
line3.draw(win)
line4.draw(win)
line5.draw(win)
line6.draw(win)
line7.draw(win)
line8.draw(win)
line9.draw(win)


# FrontView


win.getMouse()
win.close()



