from graphics import *
from random import randint
from math import *

def main():
	win1 = GraphWin('XY Front Projection', 450, 450)  # give title and dimensions
	win1.yUp() # make right side up coordinates!
	p = [[0 for x in range(8)] for y in range(3)]
	p[0] = [0,  100,  100, 0,   0,   100,  100,0]
	p[1] = [0,  0,    100, 100, 0,   0,    100,100]
	p[2] = [0,  0,    0,   0,   100, 100,  100,100]


	print p 
	
	txy = [[0 for x in range(3)] for y in range(3)]
	txy[0] = [0.7071,0,0.7071]
	txy[1] = [0.4082,0.8166,-0.4082]
	txy[2] = [0,0,0]
	projection = [[0.0 for x in range(8)] for y in range(3)]
	for i in range(3):
		for j in range(8):
			for k in range(3):
				projection[i][j] += txy[i][k]*p[k][j]

	print projection

	p1 = Point(projection[0][0]+100,projection[1][0]+100)
	p2 = Point(projection[0][1]+100,projection[1][1]+100)
	p3 = Point(projection[0][2]+100,projection[1][2]+100)
	p4 = Point(projection[0][3]+100,projection[1][3]+100)
	p5 = Point(projection[0][4]+100,projection[1][4]+100)
	p6 = Point(projection[0][5]+100,projection[1][5]+100)
	p7 = Point(projection[0][6]+100,projection[1][6]+100)
	p8 = Point(projection[0][7]+100,projection[1][7]+100)
	line1 = Line(p1,p5)
	line2 = Line(p1,p4)
	line3 = Line(p3,p4)
	line4 = Line(p4,p2)
	line5 = Line(p5,p2)
	line6 = Line(p6,p7)
	line7 = Line(p7,p2)
	line8 = Line(p6,p5)
	line9 = Line(p7,p3)
	line1.draw(win1)
	line2.draw(win1)
	line3.draw(win1)
	line4.draw(win1)
	line5.draw(win1)
	line6.draw(win1)
	line7.draw(win1)
	line8.draw(win1)
	line9.draw(win1)
	time.sleep(20)

main()