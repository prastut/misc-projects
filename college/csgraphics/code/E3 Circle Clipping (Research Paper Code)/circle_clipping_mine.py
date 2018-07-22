from graphics import *
import time


def liangBarsky (xMin, xMax, yMin, yMax, cordinate1, cordinate2, originalLineObject, windowObject):

	x1 = cordinate1.getX()
	y1 = cordinate1.getY()
	x2 = cordinate2.getX()
	y2 = cordinate2.getY()

	deltaX = x2 - x1
	deltaY = y2 - y1

	p = None
	q = None
	u1 = []
	u2 = []

	for edge in range(0,4):
		if edge == 0:
			p = -deltaX
			q = x1 - xMin
			# print "L", p, q
		if edge == 1:
			p = deltaX
			q = xMax - x1
			# print "R", p, q
		if edge == 2:
			p = -deltaY
			q = y1 - yMin
			# print "B", p, q
		if edge == 3:
			p = deltaY
			q = yMax - y1
			# print "T", p, q

		if p != 0:

			r = q/p
			if p < 0:
				u1.append(r)
			else:
				u2.append(r)

	u1.append(0)
	u2.append(1)

	print "u1", u1
	print "u2", u2
	u1 = max(u1)
	u2 = min(u2)

	print u1
	print u2

	if u1 > u2:
		return False
	else:
		x0clip = x1 + u1*deltaX
		y0clip = y1 + u1*deltaY
		x1clip = x1 + u2*deltaX
		y1clip = y1 + u2*deltaY
	
	clipped_line = Line(Point(x0clip,y0clip),Point(x1clip,y1clip))
	originalLineObject.undraw()
	clipped_line.draw(windowObject)

	return x0clip, y0clip, x1clip, y1clip, clipped_line

# def line_equation(slope, x, y):

# 	if slope:
# 		eqn = slope*(X+) 

def Slope(cordinate1,cordinate2):

	return (cordinate2.getY() - cordinate1.getY())/(cordinate2.getX()-cordinate1.getX())


def onCircle(point, center, radius):

	deltaX = point.getX() - center.getX()
	deltaY = point.getY() - center.getY()
	Norm = pow(pow(deltaX,2) + pow(deltaY,2),0.5)
	NormX = deltaX/Norm
	NormY = deltaY/Norm
	pt_int_circle = (center.getX() + radius*NormX, center.getY() + radius*NormY)
	pt_int_circle = Point(pt_int_circle[0],pt_int_circle[1])

	if point == pt_int_circle:
		return True
	else:
		return False



def circle_clipping(point, center, windowObject, mainlineSlope, radius):
	
	# while startingPt ==  and endingPt == :

	lCpoint = Line(point,center)
	# lCpoint.draw(windowObject)

	deltaX = point.getX() - center.getX()
	deltaY = point.getY() - center.getY()
	
	slope = deltaY/deltaX
	slopePerp = -1/slope

	Norm = pow(pow(deltaX,2) + pow(deltaY,2),0.5)
	NormX = deltaX/Norm
	NormY = deltaY/Norm
	
	pt_int_circle = (center.getX() + radius*NormX, center.getY() + radius*NormY)
	pt_int_circle = Point(pt_int_circle[0],pt_int_circle[1])
	pt_int_circle.draw(windowObject)

	m1x1 = slopePerp*pt_int_circle.getX() 
	m2x2 = mainlineSlope*point.getX()
	
	newX = (point.getY() - pt_int_circle.getY() + m1x1 - m2x2)/(slopePerp - mainlineSlope)
	newY = mainlineSlope*(newX - point.getX()) + point.getY()

	point = Point(newX,newY)
	point.draw(windowObject)
	return point



def main():
	win = GraphWin('Circle Clipping', 1000, 1000)  # give title and dimensions
	win.yUp() # make right side up coordinates!

	time.sleep(1)
	

	x_center = win.getWidth()/2
	y_center = win.getHeight()/2 + 100
	radius = 300
	clipping_circle = Circle(Point(x_center,y_center), radius) # set center and radius
	clipping_circle.draw(win)

	cordinate1 = win.getMouse()
	cordinate1.draw(win)

	cordinate2 = win.getMouse()
	cordinate2.draw(win)
	linebtwpoints = Line(cordinate1, cordinate2)
	linebtwpoints.draw(win)

	time.sleep(1)

	xMin_line = Line(Point(x_center-radius,y_center- radius), Point(x_center-radius, y_center+radius))
	xMin_line.draw(win)
	xMin = x_center-radius

	xMax_line = Line(Point(x_center+radius,y_center- radius), Point(x_center+radius, y_center+radius))
	xMax_line.draw(win)
	xMax = x_center+radius


	yMin_line = Line(Point(x_center-radius,y_center- radius),Point(x_center+radius,y_center- radius))
	yMin_line.draw(win)
	yMin = y_center-radius

	yMax_line = Line(Point(x_center-radius, y_center+radius), Point(x_center+radius, y_center+radius))
	yMax_line.draw(win)
	yMax = y_center+radius

	time.sleep(1)

	lineClipped = liangBarsky(xMin,xMax,yMin,yMax,cordinate1,cordinate2, linebtwpoints, win)

	# time.sleep(1)

	if not lineClipped:
		message = Text(Point(win.getWidth()/2, 20), 'Line cannot be clipped.')
		message.draw(win)
	else:
		center = clipping_circle.getCenter()
		center.draw(win)

		(x0,y0,x1,y1,line) = lineClipped
		startingPt = Point(x0,y0)
		endingPt = Point(x1,y1)
		lineClipped_slope = Slope(startingPt,endingPt)

		count = 0

		while count<5:
			startingPt = circle_clipping(point=startingPt, center=center, windowObject=win, mainlineSlope=lineClipped_slope, radius=clipping_circle.getRadius())
			endingPt = circle_clipping(point=endingPt, center=center, windowObject=win, mainlineSlope=lineClipped_slope, radius=clipping_circle.getRadius())
			line.undraw()
			line = Line(startingPt,endingPt)
			line.draw(win)
			count = count +1
			print count

	win.getMouse()
	win.close()

main()