import numpy as np
from graphics import *

from math import sin, cos, radians

win = GraphWin('Hello', 500, 500)
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

r = -1/float(-200)


for x in range(8):
	print 100*r + 1
	cube[0,x] = cube[0,x]/(100*r+1)
	cube[1,x] = cube[1,x]/(100*r+1)
		

print cube


points = []

for x in range(8):
	point = Point(cube[0,x]+200, cube[1,x]+200)
	point.draw(win)
	points.append(point)


# FrontView


win.getMouse()
win.close()



