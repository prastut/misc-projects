from graphics import *
from random import randint
from math import *

def main():
	win1 = GraphWin('XY Front Projection', 500, 500)  # give title and dimensions
	win1.yUp() # make right side up coordinates!
	win2 = GraphWin('XZ Top Projection', 500, 500)  # give title and dimensions
	win2.yUp() # make right side up coordinates!
	win3 = GraphWin('YZ Right Projection', 500, 500)  # give title and dimensions
	win3.yUp() # make right side up coordinates!
	p = [[0 for x in range(8)] for y in range(3)]
	print p

	p[0] = [0,100, 100,0,0,100,100,0]
	p[1] = [0,0,   100,100,0,0,100,100]
	p[2] = [0,0,0,	0,200,200,200,200]

	print p
	txy = [[0 for x in range(3)] for y in range(3)]
	txy[0] = [1,0,0]
	txy[1] = [0,1,0]
	txy[2] = [0,0,0]

	print txy

	projection = [[0.0 for x in range(8)] for y in range(3)]
	for i in range(3):
		for j in range(8):
			for k in range(3):
				projection[i][j] += txy[i][k]*p[k][j]

	print projection
	
	p1 = Point(projection[0][0],projection[1][0])
	p2 = Point(projection[0][1],projection[1][1])
	p3 = Point(projection[0][2],projection[1][2])
	p4 = Point(projection[0][3],projection[1][3])
	p5 = Point(projection[0][4],projection[1][4])
	p6 = Point(projection[0][5],projection[1][5])
	p7 = Point(projection[0][6],projection[1][6])
	p8 = Point(projection[0][7],projection[1][7])
	line1 = Line(p1,p2)
	line2 = Line(p2,p3)
	line3 = Line(p3,p4)
	line4 = Line(p4,p1)
	line1.draw(win1)
	line2.draw(win1)
	line3.draw(win1)
	line4.draw(win1)

	txz = [[0 for x in range(3)] for y in range(3)]
	txz[0] = [1,0,0]
	txz[1] = [0,0,0]
	txz[2] = [0,0,1]
	projection = [[0.0 for x in range(8)] for y in range(3)]
	for i in range(3):
		for j in range(8):
			for k in range(3):
				projection[i][j] += txz[i][k]*p[k][j]
	p1 = Point(projection[2][0],projection[0][0])
	p2 = Point(projection[2][1],projection[0][1])
	p3 = Point(projection[2][2],projection[0][2])
	p4 = Point(projection[2][3],projection[0][3])
	p5 = Point(projection[2][4],projection[0][4])
	p6 = Point(projection[2][5],projection[0][5])
	p7 = Point(projection[2][6],projection[0][6])
	p8 = Point(projection[2][7],projection[0][7])
	
	line1 = Line(p1,p2)
	line2 = Line(p2,p6)
	line3 = Line(p6,p5)
	line4 = Line(p5,p1)
	line1.draw(win2)
	line2.draw(win2)
	line3.draw(win2)
	line4.draw(win2)

	tyz = [[0 for x in range(3)] for y in range(3)]
	tyz[0] = [0,0,0]
	tyz[1] = [0,1,0]
	tyz[2] = [0,0,1]
	projection = [[0.0 for x in range(8)] for y in range(3)]
	for i in range(3):
		for j in range(8):
			for k in range(3):
				projection[i][j] += tyz[i][k]*p[k][j]
	p1 = Point(projection[2][0],projection[1][0])
	p2 = Point(projection[2][1],projection[1][1])
	p3 = Point(projection[2][2],projection[1][2])
	p4 = Point(projection[2][3],projection[1][3])
	p5 = Point(projection[2][4],projection[1][4])
	p6 = Point(projection[2][5],projection[1][5])
	p7 = Point(projection[2][6],projection[1][6])
	p8 = Point(projection[2][7],projection[1][7])
	line1 = Line(p1,p3)
	line2 = Line(p3,p7)
	line3 = Line(p7,p5)
	line4 = Line(p5,p1)
	line1.draw(win3)
	line2.draw(win3)
	line3.draw(win3)
	line4.draw(win3)
	
	win1.getMouse()
	win1.close()

	win2.getMouse()
	win2.close()

	win3.getMouse()
	win3.close()


	# win1.close()
	# win2.close()
	# win3.close()

main()