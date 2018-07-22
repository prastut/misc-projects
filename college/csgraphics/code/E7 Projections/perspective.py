from graphics import *
from random import randint
from math import *

def main():
	win1 = GraphWin('Perspective', 450, 450)  # give title and dimensions
	win1.yUp() # make right side up coordinates!
	p = [[0 for x in range(8)] for y in range(3)]
	p[0] = [0,100,100,0,0,100,100,0]
	p[1] = [0,0,100,100,0,0,100,100]
	p[2] = [0,0,0,0,100,100,100,100]
	zc = -200
	flag = 0
	while(1):
		if flag>0:
			line5.undraw()
			line6.undraw()
			line7.undraw()
			line8.undraw()
		choice = input("Enter 1 for going closer, 2 for going away and 3 for terminating")
		if(choice == 1):
			zc -= 50
		elif(choice == 2):
			zc += 50
		else: 
			break
		projection = [[0 for x in range(8)] for y in range(3)]
		for i in range(8):
			r = -1/float(zc)
			projection[0][i] = (p[0][i])/(100*r+1)
			projection[1][i] = (p[1][i])/(100*r+1)
		p1 = Point(projection[0][0]+100,projection[1][0]+100)
		p2 = Point(projection[0][1]+100,projection[1][1]+100)
		p3 = Point(projection[0][2]+100,projection[1][2]+100)
		p4 = Point(projection[0][3]+100,projection[1][3]+100)
		p5 = Point(projection[0][4]+100,projection[1][4]+100)
		p6 = Point(projection[0][5]+100,projection[1][5]+100)
		p7 = Point(projection[0][6]+100,projection[1][6]+100)
		p8 = Point(projection[0][7]+100,projection[1][7]+100)
		print p1
		print p2
		print p3
		print p4
		print p5
		print p6
		print p7
		print p8
		line5 = Line(p5,p6)
		line6 = Line(p6,p7)
		line7 = Line(p7,p8)
		line8 = Line(p8,p5)

		line5.draw(win1)
		line6.draw(win1)
		line7.draw(win1)
		line8.draw(win1)
		p1 = Point(projection[0][0]+250,projection[1][0]+250)
		p2 = Point(projection[0][1]+250,projection[1][1]+250)
		p3 = Point(projection[0][2]+250,projection[1][2]+250)
		p4 = Point(projection[0][3]+250,projection[1][3]+250)
		p5 = Point(projection[0][4]+250,projection[1][4]+250)
		p6 = Point(projection[0][5]+250,projection[1][5]+250)
		p7 = Point(projection[0][6]+250,projection[1][6]+250)
		p8 = Point(projection[0][7]+250,projection[1][7]+250)
		print p1
		print p2
		print p3
		print p4
		print p5
		print p6
		print p7
		print p8
		line1 = Line(p5,p6)
		line2 = Line(p6,p7)
		line3 = Line(p7,p8)
		line4 = Line(p8,p5)

		line1.draw(win1)
		line2.draw(win1)
		line3.draw(win1)
		line4.draw(win1)
		flag += 1
		time.sleep(2)
		

main()