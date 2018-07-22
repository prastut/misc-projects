from sympy import *

x = Symbol('x')
y = Symbol('y')

sol =  solve([pow(x-2,2)+pow(y+3,2)-4, 2*x + 2*y + 1], [x, y])

for x in sol:
	