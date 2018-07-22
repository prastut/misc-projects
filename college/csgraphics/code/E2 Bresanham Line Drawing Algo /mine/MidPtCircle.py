from graphics import *


win = GraphWin('Hello', 500, 500)
win.yUp()
win.setCoords(-100,-100,100,100)



(x,y) = (0,0)
point = Point(x,y)
point.draw(win)

D = 5/4 - 50;

#first Pt
y = y + 50
point = Point(x,y)
point.draw(win)


points = []
points.append([x,y])

while (x<=y):
	if D <= 0:
		x = x + 1
		D = D + 2*x + 1
	else:
		x = x + 1
		y = y - 1
		D = D + 2*x + 1 - 2*y + 1

	print x,y 

	point = [x,y]
	points.append(point)

for x, point in enumerate(points):
	oc1 = Point(point[1], point[0])
	oc3 = Point(-point[0], point[1])
	oc5 = Point(-point[1], -point[0])
	oc7 = Point(point[0], -point[1])

	oc1.draw(win)
	oc3.draw(win)
	oc5.draw(win)
	oc7.draw(win)
	



win.getMouse()
win.close()
