#Operator APIs for Operator UI (http://api.op.24kbet.com)

## APIs

1. [POST] /auth/login
    * username
    * password
    * [RETURN] jwt-token OR error message
    
2. [GET] /auth/logout
    * [RETURN] success or fail

3. [GET] /profile
    * [RETURN] operator's profile json object
    
4. [POST] /password
    * UPDATE operator's password, RETURN success or failed
    
5. [GET] /settings
    * [RETURN] json object, one object each game/lottery

6. [GET] /users?parameters...
    * [RETURN] the users belongs to this operator with pagination
    
7. [GET] /history?parameters...
    * [RETURN] the game history belongs to this operator with pagination
    
8. TBD