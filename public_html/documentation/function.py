    
def convertNum2Bytes(byte1, byte0):
    return (( byte1 * 256) + byte0 )
    
    
def convertNum4Bytes(byte3, byte2, byte1, byte0):
    return ((byte3 * 16777216) + (byte2 * 65536) + (byte1 * 256) + (byte0))
    
    
    
class Block310Data(object):
    def __init__(self, recordNum=None, automatic=False, p2pAplitude=False, duration=None, coupling=None):
        self.recordNum = recordNum
        self.automatic = automatic
        self.p2pAplitude = p2pAplitude
        self.duration = duration
        self.coupling = coupling