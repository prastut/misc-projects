from OpenGL.GL import *
from OpenGL.GLU import *
from OpenGL.GLUT import *

g_fViewDistance = 9.
g_Width = 600
g_Height = 600

g_nearPlane = 1.
g_farPlane = 1000.

action = ""
xStart = yStart = 0.
zoom = 0.

xRotate = 0.
yRotate = 0.
zRotate = 0.

xTrans = 0.
yTrans = 0.


def scenemodel():
    glRotate(90,0.,0.,1.)
    glutWireTeapot(1.)

def init():
    glEnable(GL_NORMALIZE)
    glLightfv(GL_LIGHT0,GL_POSITION,[ .0, 10.0, 10., 0. ] )
    glLightfv(GL_LIGHT0,GL_AMBIENT,[ .0, .0, .0, 1.0 ]);
    glLightfv(GL_LIGHT0,GL_DIFFUSE,[ 1.0, 1.0, 1.0, 1.0 ]);
    glLightfv(GL_LIGHT0,GL_SPECULAR,[ 1.0, 1.0, 1.0, 1.0 ]);
    glEnable(GL_LIGHT0)
    glEnable(GL_LIGHTING)
    glEnable(GL_DEPTH_TEST)
    glDepthFunc(GL_LESS)
    glShadeModel(GL_SMOOTH)
    resetView()


def resetView():
    global zoom, xRotate, yRotate, zRotate, xTrans, yTrans
    zoom = 65.
    xRotate = 0.
    yRotate = 0.
    zRotate = 0.
    xTrans = 0.
    yTrans = 0.
    glutPostRedisplay()

def display():
    # Clear frame buffer and depth buffer
    glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT)
    # Set up viewing transformation, looking down -Z axis
    glLoadIdentity()

    gluLookAt(0, 0, -g_fViewDistance, 0, 0, 0, -.1, 0, 0)   #-.1,0,0
    # Set perspective (also zoom)
    glMatrixMode(GL_PROJECTION)
    glLoadIdentity()
    gluPerspective(zoom, float(g_Width)/float(g_Height), g_nearPlane, g_farPlane)
    # glOrtho(-5.0, 5, -5.0, 5, g_nearPlane, g_farPlane)
    glMatrixMode(GL_MODELVIEW)
    # Rendering the scene
    polarView()
    scenemodel()
    # To make sure changes appear onscreen
    glutSwapBuffers()


def reshape(width, height):
    global g_Width, g_Height
    g_Width = width
    g_Height = height
    glViewport(0, 0, g_Width, g_Height)
    

def polarView():
    glTranslatef( yTrans/100., 0.0, 0.0 )
    glTranslatef(  0.0, -xTrans/100., 0.0)
    glRotatef( -zRotate, 0.0, 0.0, 1.0)
    glRotatef( -xRotate, 1.0, 0.0, 0.0)
    glRotatef( -yRotate, .0, 1.0, 0.0)
   

def keyboard(key, x, y):
    global zTr, yTr, xTr
    if(key=='r'): resetView()
    if(key=='q'): exit(0)
    glutPostRedisplay()


def mouse(button, state, x, y):
    global action, xStart, yStart
    print "------------"
    print "Mouse"
    print "x->",x,"y->",y
    print "------------"
    
    if (button==GLUT_LEFT_BUTTON):
        if (glutGetModifiers() == GLUT_ACTIVE_SHIFT):
            action = "MOVE_EYE_2"
        else:
            action = "MOVE_EYE"
    elif (button==GLUT_MIDDLE_BUTTON):
        action = "TRANS"
    elif (button==GLUT_RIGHT_BUTTON):
        action = "ZOOM"
    xStart = x
    yStart = y


def motion(x, y):
    print "------------"
    print "Motion"
    print "x->",x,"y->",y
    print "------------"
    
    global zoom, xStart, yStart, xRotate, yRotate, zRotate, xTrans, yTrans
    if (action=="MOVE_EYE"):
        xRotate += x - xStart
        yRotate -= y - yStart
    elif (action=="MOVE_EYE_2"):
        zRotate += y - yStart
    elif (action=="TRANS"):
        xTrans += x - xStart
        yTrans += y - yStart
    elif (action=="ZOOM"):
        zoom -= y - yStart
        if zoom > 150.:
            zoom = 150.
        elif zoom < 1.1:
            zoom = 1.1
    else:
        print("unknown action\n", action)
    xStart = x
    yStart = y 
    glutPostRedisplay()


if __name__=="__main__":
    # GLUT Window Initialization
    glutInit()
    glutInitDisplayMode (GLUT_DOUBLE | GLUT_RGB| GLUT_DEPTH)      # zBuffer
    glutInitWindowSize (g_Width,g_Height) 
    glutInitWindowPosition (0 + 4, g_Height / 4)
    glutCreateWindow ("Graphics Lab OpenGL")
    # Initialize OpenGL graphics state
    init ()
    # Register callbacks
    glutReshapeFunc(reshape)
    glutDisplayFunc(display)    
    glutMouseFunc(mouse)
    glutMotionFunc(motion)
    glutKeyboardFunc(keyboard)
    # Turn the flow of control over to GLUT
    glutMainLoop()
