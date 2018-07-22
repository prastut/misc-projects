import turtle
turtle.speed(0)

ruleInput = ['F']
ruleOutput = ["+F--F+"]
start = "F"

front = 5
turnL = 45
turnR = 135

stack = []
dirstack = []

turtle.left(90)
turtle.left(90)

turtle.penup()
turtle.setpos(0, 0)
turtle.pendown()
# turtle.shape("turtle")

def generate(iteration):
	result = start
	temp = ""
	for i in range(iteration):
		for j in range(len(result)):
			for k in range(len(ruleInput)):
				if (result[j] == ruleInput[k]):
					temp += ruleOutput[k]
					break
				if (k == len(ruleInput)-1):
					temp += result[j]
		print result
		result = temp
		temp = ""
	return result

def draw(input):
	for x in input:
		if (x == 'F'):
			turtle.forward(front)
		elif (x == '-'):
			turtle.left(turnR)
		elif (x == '+'):
			turtle.left(turnL)
	turtle.hideturtle()
	turtle.done()

def main():
	iteration = raw_input("Enter the number of iterations->")
	draw(generate(int(iteration)))

main()


