import numpy as np
from graphics import *

win = GraphWin('Hello', 1000, 1000)
win.yUp()



cube = np.matrix([
					[250,250,250], 
					[350,250,250],
					[350,350,250],
					[250,350,250], 
					[250,250,450], 
					[350,250,450],
					[350,350,450],
					[250,350,450]

				])

cube = cube.getT()

frontView = np.matrix([
						[1,0,0],
						[0,1,0],
						[0,0,0]

					])



sideView = np.matrix([

						[0,0,0],
						[0,1,0],
						[0,0,1]
					])


topview = np.matrix([

						[1,0,0],
						[0,0,0],
						[0,0,1]

					])


# FrontView
projectFrontView =  np.dot(frontView,cube)

points = []

for x in range(8):
	point = Point(projectFrontView.item(x), projectFrontView.item(x+8))
	point.draw(win)
	points.append(point)


for x in range(4):
	line = Line(points[x],points[x+1])
	line.draw(win)

#SideView
projectSideView = np.dot(sideView, cube)

points = []

for x in range(8):
	point = Point(projectSideView.item(x+16)+500, projectSideView.item(x+8))
	point.draw(win)
	points.append(point)


#TopView
projectTopView = np.dot(topview,cube)

for x in range(8):
	point = Point(projectTopView.item(x), projectTopView.item(x+16)+500)
	point.draw(win)
	points.append(point)





win.getMouse()
win.close()



