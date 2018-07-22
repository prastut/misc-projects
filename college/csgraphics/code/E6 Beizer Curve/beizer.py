from graphics import *
import numpy as np

degree = raw_input("Please enter degree of Polynomial or type 1 for matka->")
degree = int(degree)

win = GraphWin("Bizer Curve Final", 1000, 1000)

#initalization stuff
count = 0
points = []

if degree == 2:
	Mmatrix = [[1,0,0],[-2,2,0],[1,-2,1]]
	count_till = 2
	message = Text(Point(win.getWidth()/2, 20), 'Quadratic Beizer Curve')
	message.draw(win)
elif degree == 3 or degree == 1:
	Mmatrix = [[1,0,0,0],[-3,3,0,0],[3,-6,3,0],[-1,3,-3,1]]
	count_till = 3
	if degree == 3:
		message = Text(Point(win.getWidth()/2, 20), 'Cubic Beizer Curve')
	else:
		message = Text(Point(win.getWidth()/2, 20), 'Matka')
	message.draw(win)
else:
	print "Wrong Argument"
	exit()


# First point
if degree != 1:
	clickPoint = win.getMouse()
	points.append(clickPoint)
	clickPoint.draw(win)


	while count < count_till: 
		clickPoint = win.getMouse()
		points.append(clickPoint)
		clickPoint.draw(win)

		linebtwpoints = Line(points[count], points[count+1])
		linebtwpoints.draw(win)
		count= count + 1


	xMatrix = []
	yMatrix = []
	plotList = []

	for p in points:
		xMatrix.append([p.getX()])
		yMatrix.append([p.getY()])


	def frange(x, y, jump):
		while x < y:
			yield x
			x += jump

	t = list(frange(0,1,0.005))



	for index, element in enumerate(t):
		if degree == 2:
			tmatrix = [[1,element,pow(element,2)]]
		elif degree == 3:
			tmatrix = [[1,element,pow(element,2),pow(element,3)]]

		x = np.dot(tmatrix,np.dot(Mmatrix, xMatrix))
		y = np.dot(tmatrix,np.dot(Mmatrix, yMatrix))
		plotList.append(Point(x,y))

	for i in plotList:
		i.draw(win)

else: 

	clickPoint = win.getMouse()
	points.append(clickPoint)
	clickPoint.draw(win)

	while count < count_till: 
		clickPoint = win.getMouse()
		points.append(clickPoint)
		clickPoint.draw(win)

		# linebtwpoints = Line(points[count], points[count+1])
		# linebtwpoints.draw(win)
		count= count + 1

	xMatrix = []
	yMatrix = []
	plotList = []

	for p in points:
		xMatrix.append([p.getX()])
		yMatrix.append([p.getY()])


	def frange(x, y, jump):
		while x < y:
			yield x
			x += jump

	t = list(frange(0,1,0.005))



	for index, element in enumerate(t):
		tmatrix = [[1,element,pow(element,2),pow(element,3)]]
		x = np.dot(tmatrix,np.dot(Mmatrix, xMatrix))
		y = np.dot(tmatrix,np.dot(Mmatrix, yMatrix))
		plotList.append(Point(x,y))

	for i in plotList:
		i.draw(win)

	xCenter = points[1].getX()

	reflectionpoints = []
	xMatrix = []
	yMatrix = []
	plotList = []

	for point in range(0,4):
			newX = xCenter - points[point].getX()
			mirror = Point(newX + xCenter, points[point].getY())
			mirror.draw(win)
			reflectionpoints.append(mirror)

	# for point in range(0,3):
	# 	linebtwreflectionpoints = Line(reflectionpoints[point], reflectionpoints[point+1])
	# 	linebtwreflectionpoints.draw(win)

	for p in reflectionpoints:
		xMatrix.append([p.getX()])
		yMatrix.append([p.getY()])

	for index, element in enumerate(t):
		tmatrix = [[1,element,pow(element,2),pow(element,3)]]
		x = np.dot(tmatrix,np.dot(Mmatrix, xMatrix))
		y = np.dot(tmatrix,np.dot(Mmatrix, yMatrix))
		plotList.append(Point(x,y))

	for i in plotList:
		i.draw(win)

	topLine = Line(points[0],reflectionpoints[0])
	bottomLine = Line(points[3], reflectionpoints[3])
	topLine.draw(win)
	bottomLine.draw(win)

win.getMouse()

win.close()

