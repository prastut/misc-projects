from graphics import *
from random import randint
from math import *
def drawSquare(win,p1,p2,p3,p4,color):
	#xMin = min(p1.getX(),p2.getX(),p3.getX(),p4.getX())
	#yMin = min(p1.getY(),p2.getY(),p3.getY(),p4.getY())
	#xMax = max(p1.getX(),p2.getX(),p3.getX(),p4.getX())
	#yMax = max(p1.getY(),p2.getY(),p3.getY(),p4.getY())
	#rect = Rectangle(Point(xMin,yMin),Point(xMax,yMax))
	#rect.draw(win)
	#rect.setFill(color)
	#time.sleep(3)
	#rect.undraw()
	poly = Polygon(p1,p2,p4,p3)
	poly.draw(win)
	poly.setFill(color)
	poly.setOutline(color)
	return poly
def movePoints(x,y,p1,p2,p3,p4):
	if(x<0):
		p1.move(500,0)
		p2.move(500,0)
		p3.move(500,0)
		p4.move(500,0)
	if(x>1000):
		p1.move(-500,0)
		p2.move(-500,0)
		p3.move(-500,0)
		p4.move(-500,0)
	if(y<0):
		p1.move(0,500)
		p2.move(0,500)
		p3.move(0,500)
		p4.move(0,500)
	if(y>1000):
		p1.move(0,-500)
		p2.move(0,-500)
		p3.move(0,-500)
		p4.move(0,-500)

def transform(p1,p2,p3,p4,win):
	tx = randint(-250,250)
	ty = randint(-250,250)
	theta = (30.0*22.0)/(7.0*180.0)
	colors = ['red','yellow','green','blue','violet','brown','orange']
	t = [[0.0 for x in range(3)] for y in range(3)]
	r = [[0.0 for x in range(3)] for y in range(3)]
	t[0][0] = t[1][1] = t[2][2] = r[2][2] = 1 
	r[0][2] = r[1][2] = r[2][0] = r[2][1] = t[0][1] = t[1][0] = t[2][0] = t[2][1] = 0
	t[0][2] = tx
	t[1][2] = ty
	r[0][0] = r[1][1] = cos(theta)
	r[1][0] = sin(theta)
	r[0][1] = -1*r[1][0]
	composite = [[0.0 for x in range(3)] for y in range(3)]
	for i in range(3):
		for j in range(3):
			for k in range(3):
				composite[i][j] += t[i][k]*r[k][j]
	x1 = composite[0][0]*p1.getX() + composite[0][1]*p1.getY() + composite[0][2]
	y1 = composite[1][0]*p1.getX() + composite[1][1]*p1.getY() + composite[1][2]
	if(x1<0 or x1>1000 or y1<0 or y1>1000):
		movePoints(x1,y1,p1,p2,p3,p4)
		return [p1,p2,p3,p4,0]
	x2 = composite[0][0]*p2.getX() + composite[0][1]*p2.getY() + composite[0][2]
	y2 = composite[1][0]*p2.getX() + composite[1][1]*p2.getY() + composite[1][2]
	if(x2<0 or x2>1000 or y2<0 or y2>1000):
		movePoints(x2,y2,p1,p2,p3,p4)
		return [p1,p2,p3,p4,0]
	x3 = composite[0][0]*p3.getX() + composite[0][1]*p3.getY() + composite[0][2]
	y3 = composite[1][0]*p3.getX() + composite[1][1]*p3.getY() + composite[1][2]
	if(x3<0 or x3>1000 or y3<0 or y3>1000):
		movePoints(x3,y3,p1,p2,p3,p4)
		return [p1,p2,p3,p4,0]
	x4 = composite[0][0]*p4.getX() + composite[0][1]*p4.getY() + composite[0][2]
	y4 = composite[1][0]*p4.getX() + composite[1][1]*p4.getY() + composite[1][2]
	if(x4<0 or x4>1000 or y4<0 or y4>1000):
		movePoints(x4,y4,p1,p2,p3,p4)
		return [p1,p2,p3,p4,0]
	p1 = Point(x1,y1)
	p2 = Point(x2,y2)
	p3 = Point(x3,y3)
	p4 = Point(x4,y4)
	color = randint(0,6)
	poly = drawSquare(win,p1,p2,p3,p4,colors[color])
	return [p1,p2,p3,p4,1,poly]

def main():
	win = GraphWin('Screen Saver', 1000, 1000)  # give title and dimensions
	win.yUp() # make right side up coordinates!
	coordinate = 0
	colors = ['red','yellow','green','blue','violet','brown','orange']
	p1 = []
	p2 = []
	p3 = []
	p4 = []
	poly = []
	num = randint(20,40)
	for i in range(num):
		p = randint(100,900)
		p1.append(Point(p+0.0,p+0.0))
		p2.append(Point(p+0.0,p+25.0))
		p3.append(Point(p+25.0,p+0.0))
		p4.append(Point(p+25.0,p+25.0))
		color = randint(0,6)
		poly.append(drawSquare(win,p1[i],p2[i],p3[i],p4[i],colors[color]))
	for i in range(num):
		poly[i].undraw()
	while(coordinate<20):
		for i in range(num):
			newPoints = transform(p1[i],p2[i],p3[i],p4[i],win)
			while(newPoints[4] == 0):
				newPoints = transform(newPoints[0],newPoints[1],newPoints[2],newPoints[3],win)
			p1[i] = newPoints[0]
			p2[i] = newPoints[1]
			p3[i] = newPoints[2]
			p4[i] = newPoints[3]
			poly[i] = newPoints[5]
		time.sleep(2)
		for i in range(num):
			poly[i].undraw()
		coordinate += 1
	win.close()

main()